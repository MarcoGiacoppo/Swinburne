const app = Vue.createApp({
    data() {
        return {
            message: 'Start guessing',
            userGuess: null,
            numberToGuess: null
        }
    },
    methods: {
        checkGuess() {
            if (this.userGuess === null || isNaN(this.userGuess)) {
                alert('Please enter a valid number.');
                return;
            }
            
            if (this.userGuess == this.numberToGuess) {
                this.message = 'You got it!';
            } else if (this.userGuess < this.numberToGuess) {
                this.message = 'Guess higher';
            } else {
                this.message = 'Guess lower';
            }
        },
        giveUp() {
            this.message = `The number was ${this.numberToGuess}.`;
        },
        startOver() {
            this.message = 'Start guessing';
            this.userGuess = null;
            this.numberToGuess = this.generateRandomNumber();
        },
        generateRandomNumber() {
            return Math.floor(Math.random() * 100) + 1; // Generating a random number between 1 and 100
        }
    },
    created() {
        this.numberToGuess = this.generateRandomNumber();
    }
});

app.mount('#app');
