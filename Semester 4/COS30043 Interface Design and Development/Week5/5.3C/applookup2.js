// Defining the list of unit in an array
var units = [
    { code: "ICT10001",
      desc: "Problem Solving with ICT",
      credit: 12.5,
      type: "Core"
    },
    { code: "COS10005", 
      desc: "Web Development", 
      credit: 12.5, 
      type: "Core" 
    },
    {
      code: "INF10003",
      desc: "Introduction to Business Information Systems",
      credit: 12.5,
      type: "Core",
    },
    {
      code: "INF10002",
      desc: "Database Analysis and Design",
      credit: 12.5,
      type: "Core",
    },
    {
      code: "COS10009",
      desc: "Introduction to Programming",
      credit: 12.5,
      type: "Core",
    },
    {
      code: "INF30029",
      desc: "Information Technology Project Management",
      credit: 12.5,
      type: "Core",
    },
    {
      code: "ICT30005",
      desc: "Professional Issues in Information Technology",
      credit: 12.5,
      type: "Core",
    },
    {
      code: "ICT30001",
      desc: "Information Technology Project",
      credit: 12.5,
      type: "Core",
    },
    {
      code: "COS20001",
      desc: "User-Centred Design",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "TNE10005",
      desc: "Network Administration",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "COS20016",
      desc: "Operating System Configuration",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "SWE20001",
      desc: "Development Project 1 - Tools and Practices",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "COS20007",
      desc: "Object Oriented Programming",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "COS30015",
      desc: "IT Security",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "COS30043",
      desc: "Interface Design and Development",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "COS30017",
      desc: "Software Development for Mobile Devices",
      credit: 12.5,
      type: "Software Development",
    },
    {
      code: "INF20012",
      desc: "Enterprise Systems",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "ACC10007",
      desc: "Financial Information for Decision Making",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "INF20003",
      desc: "Requirements Analysis and Modelling",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "ACC20014",
      desc: "Management Decision Making",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "INF30005",
      desc: "Business Process Management",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "INF30003",
      desc: "Business Information Systems Analysis",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "INF30020",
      desc: "Information Systems Risk and Security",
      credit: 12.5,
      type: "Systems Analysis",
    },
    {
      code: "INF30001",
      desc: "Systems Acquisition & Implementation Management",
      credit: 12.5,
      type: "Systems Analysis",
    },
  ];
  
  // Component for displaying a list of units
  const UnitList = {
    data() {
      return { units };
    },
    
    // Defining the template for the route results
    template: `
          <div>
              <h2>Unit List</h2>
              <table class="table table-striped table-hover">
              <tr>
                <th>Code</th>
                <th>Description</th>
                <th>More Info</th>
              </tr>
              <tr v-for="unit in units" >
                <td>{{ unit.code }}</td>
                <td>{{ unit.desc }}</td>
                <td><router-link :to="'/unit/' + unit.code">
                    Show Info
                </router-link></td>
              </tr>
            </table>
          </div>
      `,
  };
  
  // Component for displaying unit details
const UnitDetails = {
  props: ['unit'],
  template: `
      <div>
          <h2>Unit Details</h2>
          <div v-if="unit">
              <p><strong>Code:</strong> {{ unit.code }}</p>
              <p><strong>Name:</strong> {{ unit.desc }}</p>
              <p><strong>Credit Points:</strong> {{ unit.credit }}</p>
              <p><strong>Type:</strong> {{ unit.type }}</p>
          </div>
      </div>
  `,
};

const router = VueRouter.createRouter({
  history: VueRouter.createWebHashHistory(),
  routes: [
      { path: "/", component: UnitList },
      { path: "/unit/:code", component: {
          template: '<unit-details :unit="unit"></unit-details>',
          data() {
              return {
                  unit: null
              };
          },
          mounted() {
              const unitCode = this.$route.params.code;
              this.unit = units.find((unit) => unit.code === unitCode);
          },
          components: { 'unit-details': UnitDetails }
      }},
  ],
});

const app = Vue.createApp({});
app.use(router);
app.mount("#app");