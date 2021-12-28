<?php

/**
 * Created by PhpStorm.
 * User: larisa
 * Date: 06.08.2021
 * Time: 21:48
 */

namespace app\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

class Pager extends \yii\widgets\LinkPager
{

    /**
     * @var string the CSS class for all pages text.
     */
    public $allPagesCssClass = 'pagination__all';

    /**
     * Executes the widget.
     * This overrides the parent implementation by displaying the generated page buttons.
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        echo $this->renderPageButtons();
    }


    /**
     * Renders the page buttons.
     * @return string the rendering result
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $firstPageLabel,
                0,
                $this->firstPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton(
                $this->prevPageLabel,
                $page,
                $this->prevPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        if ($pageCount <= 6) {
            [$beginPage, $endPage] = $this->getPageRange();
            for ($i = $beginPage; $i <= $endPage; ++$i) {
                $buttons[] = $this->renderPageButton(
                    $i + 1,
                    $i,
                    null,
                    $this->disableCurrentPageButton && $i == $currentPage,
                    $i == $currentPage
                );
            }
        } else {
            // internal pages
            [$beginPage, $endPage] = $this->getPageRange();
            for ($i = 0; $i <= 2; ++$i) {
                $buttons[] = $this->renderPageButton(
                    $i + 1,
                    $i,
                    null,
                    $this->disableCurrentPageButton && $i == $currentPage,
                    $i == $currentPage
                );
            }

            if ($currentPage <= 2 || $currentPage >= ($endPage - 2)) {
                $buttons[] = '<span class="auctions__pagination__item">...</span>';
            }
            else {
                if ($currentPage !== 3) {
                    $buttons[] = '<span class="auctions__pagination__item">...</span>';
                }
                for ($i = 3; $i < ($endPage - 2); ++$i) {
                    if ($i == $currentPage) {
                        $buttons[] = $this->renderPageButton(
                            $i + 1,
                            $i,
                            null,
                            $this->disableCurrentPageButton && $i == $currentPage,
                            $i == $currentPage
                        );
                    }
                }
                if ($currentPage !== ($endPage - 3)) {
                    $buttons[] = '<span class="auctions__pagination__item">...</span>';
                }
            }
            for ($i = $endPage - 2; $i <= $endPage; ++$i) {
                $buttons[] = $this->renderPageButton(
                    $i + 1,
                    $i,
                    null,
                    $this->disableCurrentPageButton && $i == $currentPage,
                    $i == $currentPage
                );
            }
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton(
                $this->nextPageLabel,
                $page,
                $this->nextPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $lastPageLabel,
                $pageCount - 1,
                $this->lastPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        return Html::tag($tag, implode("\n", $buttons), $options);
    }

    /**
     * Renders a page button.
     * You may override this method to customize the generation of page buttons.
     *
     * @param string $label the text label for the button
     * @param int $page the page number
     * @param string $class the CSS class for the page button.
     * @param bool $disabled whether this page button is disabled
     * @param bool $active whether this page button is active
     *
     * @return string the rendering result
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active, $options = [])
    {
        $options = ArrayHelper::merge($this->linkContainerOptions, $options);

        Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $disabledItemOptions = $this->disabledListItemSubTagOptions;
            $tag = ArrayHelper::remove($disabledItemOptions, 'tag', 'span');

            return Html::tag($tag, $label, ArrayHelper::merge($options, $disabledItemOptions));
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        return Html::a($label, $this->pagination->createUrl($page), ArrayHelper::merge($options, $linkOptions));
    }

}
