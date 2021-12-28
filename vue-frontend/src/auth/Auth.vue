<template>
	<form class="modal-form" @submit.prevent>
		<div class="form-group field-authbyphoneform-phone required">
			<label class="form-group modal-label modal-input-title" for="auth-phone">Телефон</label>
			<masked-input
				id="auth-phone"
				class="form-control common-input modal-input"
				v-model="privatePhone"
				mask="\+\7 (111) 111-1111"
				placeholder="+7 (912) 345-6789"
				aria-required="true"
				ref="authPhone"
				type="79123456789"/>
			<div class="help-block"></div>
		</div>
		<div v-if="sentCode">
			<div class="form-group field-authbyphoneform-code required">
				<label class="form-group modal-label modal-input-title" for="auth-code">Код из
					сообщения</label><span class="modal-input-wrap">
							<input
								id="auth-code"
								ref="authCode"
								type="password"
								aria-required="true"
								v-model="form.code"
								@change="$refs.authCode.classList.remove('error-input')">
							<span v-if="sentCodeRepeat" class="modal-code-repeat" @click="sendCode()">Отправить код повторно</span>
							<span
								v-else
								class="modal-code-repeat modal-code-repeat--disabled">Отправить код через {{ timer.currentTime }}</span>
						</span>
			</div>
			<button class="common-btn black-btn modal-btn" @click="auth()">Войти/Зарегистрироваться</button>
		</div>
		<button v-else class="common-btn black-btn modal-btn" @click="sendCode()">Отправить код</button>
		<button class="modal-close" data-dismiss="modal">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 1L7.53333 8L1 15M15 1L8.46667 8L15 15" stroke="white" stroke-width="2"></path>
			</svg>
		</button>
	</form>
</template>

<script>
import MaskedInput from 'vue-masked-input';

export default {
	components: {
		MaskedInput
	},
	data() {
		return {
			form: {
				phone: '',
				code: '',
			},
			privatePhone: '',
			timer: {
				currentTime: 60,
				timer: null,
			},
			sentCode: false,
			sentCodeRepeat: false,
		};
	},
	computed: {
		getForm() {
			let form = new FormData();
			for (let item in this.form) {
				form.append(item, this.form[item])
			}
			return form;
		},
		currentTime() {
			return this.timer.currentTime
		},
	},
	watch: {
		currentTime(time) {
			if (time === 0) {
				clearTimeout(this.timer.timer)
				this.sentCodeRepeat = true
			}
		},
		privatePhone() {
			this.$refs.authPhone.$el.classList.remove('error-input')
			const numbers = [...this.privatePhone.matchAll('[0-9]+')]
			let phone = ''
			for (let i in numbers) {
				phone += numbers[i][0];
			}
			this.form.phone = phone;
		}
	},
	methods: {
		sendCode() {
			if (this.form.phone.length !== 11) {
				this.$refs.authPhone.$el.classList.add('error-input');
				return;
			}
			this.sentCodeRepeat = false
			this.timer.currentTime = 60
			this.axios.get(
				config_apiPath + '/auth/send-code',
				{ params: { phone: this.form.phone } }
			).then((response) => {
				if (response.status === 204) {
					this.sentCode = true;
					this.timer.timer = setInterval(() => {
						this.timer.currentTime--
					}, 1000)
				}
			})
		},
		auth() {
			this.form[yii.getCsrfParam()] = yii.getCsrfToken();
			this.axios.post(
				config_apiPath + '/auth', this.getForm,
			).then((response) => {
				if (response.status === 202) {
					document.location.replace(response.data);
				}
			}).catch((error) => {
				if (error.response.status === 422) {
					if(error.response.data[0]['field'] === 'code') {
						this.$refs.authCode.classList.add('error-input');
					}
				}
			})
		}
	}
};
</script>

