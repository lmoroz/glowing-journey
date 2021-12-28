import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

new Vue({
	el: '#informationApp',
	data: {
		...config_modelData,
		lists: {
			sex: config_sexSelect
		}
	},
	methods: {
		save() {
			this.personalInformation[yii.getCsrfParam()] = yii.getCsrfToken();
			this.axios.post(config_apiPath + '/account/information', this.personalInformation).then(
				(response) => {
					if (response.status === 202) {
						document.location.replace(response.data);
					}
				}
			).catch(error => {
				let message = '';
				let data = error.response.data;
				if (Array.isArray(data)) {
					data.map((item) => {
						message += ' '+item['message'];
					})
				}
				alert(message)
			});
		}
	}
});
