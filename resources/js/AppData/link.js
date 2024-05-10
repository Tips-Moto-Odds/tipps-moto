import {ref} from "vue";

const links = ref({
    "home":{link:"/", title:"Home"},
    "about":{link:"/about", title:"About"},
    "contact":{link:"/contact", title:"Contact"},
})

export default links;
