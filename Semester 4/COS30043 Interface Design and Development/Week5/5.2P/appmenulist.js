const app = Vue.createApp({});

app.component("mymenu", {
  props: ["menu"],
  template:
    `<ul>
        <li>Home</li>
        <li>Settings</li>
        <li>About</li>
    </ul>`,
});
app.mount("#app");