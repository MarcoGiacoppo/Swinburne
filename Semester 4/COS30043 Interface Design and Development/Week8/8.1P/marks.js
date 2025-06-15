const studMarks = [
    {"name": "Amy", "mark": 90},
    {"name": "Bill", "mark": 80},
    {"name": "Casey", "mark": 78},
    {"name": "David", "mark": 84},
    {"name": "Emma", "mark": 95},
    {"name": "Frank", "mark": 88},
    {"name": "Grace", "mark": 82},
    {"name": "Henry", "mark": 75},
    {"name": "Ivy", "mark": 92},
    {"name": "Jack", "mark": 85},
    {"name": "Kate", "mark": 79},
    {"name": "Luke", "mark": 91},
    {"name": "Mia", "mark": 87},
    {"name": "Nathan", "mark": 83},
    {"name": "Olivia", "mark": 94},
    {"name": "Peter", "mark": 76},
    {"name": "Quinn", "mark": 89},
    {"name": "Ryan", "mark": 81},
    {"name": "Samantha", "mark": 93},
    {"name": "Tom", "mark": 77},
    {"name": "Ursula", "mark": 86},
    {"name": "Victor", "mark": 90},
    {"name": "Wendy", "mark": 84},
    {"name": "Xander", "mark": 88},
    {"name": "Yara", "mark": 92},
    {"name": "Zoe", "mark": 85}
];

const app = Vue.createApp({
    data() {
        return {
            students: studMarks,
            pageSize: 3,
            currentPage: 1
        }
    },
    computed: {
        pageCount() {
            return Math.ceil(this.students.length / this.pageSize);
        },
        displayedStudents() {
            const startIndex = (this.currentPage - 1) * this.pageSize;
            const endIndex = startIndex + this.pageSize;
            return this.students.slice(startIndex, endIndex);
        }
    },
    methods: {
        changePage(pageNumber) {
            this.currentPage = pageNumber;
        }
    }
});

app.mount('#app');
