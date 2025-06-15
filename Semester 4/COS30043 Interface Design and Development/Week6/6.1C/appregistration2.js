const app = Vue.createApp({
    data() {
        return {
            formData: {
                firstName: '',
                lastName: '',
                userName: '',
                password: '',
                email: '',
                streetAddress: '',
                suburb: '',
                postcode: '',
                mobileNumber: ''
            },
            confirmPassword: '',
            errors: {},
            showTerms: false
        }
    },
    methods: {
        submitForm() {
            // Validate form data
            this.errors = {};
            if (!this.formData.firstName) {
                this.errors.firstName = 'First Name is required.';
            }
            if (!this.formData.lastName) {
                this.errors.lastName = 'Last Name is required.';
            }
            if (!this.formData.userName || this.formData.userName.length < 3) {
                this.errors.userName = 'User Name must be at least 3 characters.';
            }
            if (!this.formData.password || this.formData.password.length < 8) {
                this.errors.password = 'Password must be at least 8 characters.';
            } else if (!/[!@#$%^&*]/.test(this.formData.password)) {
                this.errors.password = 'Password must contain at least one special character ($, %, ^, &, or *)';
            }
            if (this.formData.password !== this.confirmPassword) {
                this.errors.confirmPassword = 'Passwords do not match.';
            }
            if (!this.formData.email || !this.validateEmail(this.formData.email)) {
                this.errors.email = 'Email must be in a valid format.';
            }
            if (this.formData.postcode && !/^\d{4}$/.test(this.formData.postcode)) {
                this.errors.postcode = 'Postcode must be exactly 4 numeric digits.';
            }
            if (this.formData.mobileNumber && !/^04\d{8}$/.test(this.formData.mobileNumber)) {
                this.errors.mobileNumber = 'Mobile Number must start with 04 and be 10 digits.';
            }
        
            // Check if there are no errors
            const isValid = Object.keys(this.errors).length === 0;
        
            if (isValid) {
                this.$refs.form.submit();
            }
        }
        
        ,
        toggleTerms() {
            this.showTerms = !this.showTerms;
        },
        validateEmail(email) {
            // Regular expression for email validation
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    }
});

app.mount('#app');
