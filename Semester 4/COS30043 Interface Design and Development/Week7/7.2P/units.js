const app = Vue.createApp({
    data() {
        return {
            units: []
        }
    },
    mounted() {
        this.fetchUnits();
    },
    methods: {
        fetchUnits() {
            fetch('units.json')
                .then(response => response.json())
                .then(data => {
                    this.units = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    }
});

app.mount('#app');
