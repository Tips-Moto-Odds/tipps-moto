<script setup>
import PageHeading from "@/Pages/Home/components/PageHeading.vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";


const list_items = [
    {
        heading:"Acceptance of Terms",
        content:"By accessing and using the Trendy Tips website, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions."
    },
    {
        heading:"User Data Collection",
        content:"To improve user experience and enhance our services, Trendy Tips collects certain user data. By using our website, you consent to the collection, use, and storage of your personal information as outlined in our Privacy Policy. The data we collect may include, but is not limited to, your name, email address, browsing habits, and preferences.\n"
    },
    {
        heading:"Use of Information",
        content:"The information we collect may be used for the following purposes:",
        list_item:[
            "To provide personalized content and recommendations",
            "To improve our website and user experience",
            "To communicate with you regarding updates, promotions, or other information related to our services"
        ]
    },
    {
        heading:"User Responsibilities",
        content:"Users are responsible for providing accurate, current, and complete information during registration or any interactions on our website. You are also responsible for maintaining the confidentiality of your account information and for restricting access to your account."
    },
    {
        heading:"Content Ownership and Usage",
        content:"All content on the Trendy Tips website, including text, graphics, logos, and software, is the property of Trendy Tips or our content suppliers and is protected by applicable intellectual property laws. You may not reproduce, distribute, or create derivative works from any content on our site without our express written permission."
    },
    {
        heading:"Limitation of Liability",
        content:"Trendy Tips provides tips and information for entertainment purposes only. We do not guarantee the accuracy, completeness, or usefulness of any information provided. You acknowledge that any reliance on such information is at your own risk. Trendy Tips shall not be liable for any indirect, incidental, or consequential damages arising from your use of the website."
    },
    {
        heading:"Changes to Terms",
        content:"Trendy Tips reserves the right to modify these Terms and Conditions at any time. Any changes will be effective immediately upon posting on the website. Your continued use of the website following any changes signifies your acceptance of the new terms."
    },
    {
        heading:"Governing Law",
        content:"These terms shall be governed by and construed in accordance with the laws of Kenya, without regard to its conflict of law principles."
    },
    {
        heading:"Contact Information",
        content:"If you have any questions or concerns regarding these Terms and Conditions or our data collection practices, please contact us at:"
    },
]


</script>

<template>
    <HomeLayout>
        <div class="h-[140px] mb-[40px] banner">
            <page-heading title="Terms of Service"/>
        </div>
        <div class="container text-white bg-gray-500] px-[20px]">
            <div class="content">
              <h1 class="font-bold mb-[20px]">TERMS OF SERVICE</h1>
                <h2 class="mb-[20px] text-sm font-[200]"> By using our website, you acknowledge that you have read, understood, and agreed to these Terms and
                    Conditions. Thank you for choosing Trendy Tips!</h2>
                <ol class="list-decimal px-[25px]">
                    <li v-for="item in list_items" class="mb-[20px]">
                        <h2>{{item.heading}}</h2>
                        <p class="font-[200] text-sm">{{item.content}}</p>
                        <ul class="px-[30px] list-disc" v-for="item_x in item.list_item">
                            <li>{{item_x}}</li>
                        </ul>
                    </li>
                </ol>
            </div>

        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.content {
    @apply mb-[40px];
}


.banner {
    background-image: url("/storage/System/banner.png");
    background-size: cover;
    background-position: center;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

#main-site-menu {
    position: fixed;
    right: 100%;
    transition: all ease 250ms;

    a {
        @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
    }

    a.active {
        @apply text-orange-400;
    }
}
</style>
