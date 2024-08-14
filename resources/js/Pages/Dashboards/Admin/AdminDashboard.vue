<script setup>

const props = defineProps([
    "model",
    "users",
    "payments"
])

</script>


<template>
    <div class="px-[10px]">
        <div class="app-card w-full rounded p-[20px]">

            <ul class="flex justify-between mb-[40px]">
                <li class="display-card">
                    <div class="h-[60px] p-[1px]">
                        <img class="h-[50px]" src="/storage/System/Icons/user-icon.png">
                    </div>
                    <div>
                        <h3 class="text-sm">Users</h3>
                        <p>{{ users?.users.length }}</p>
                    </div>
                    <span>up by {{ users?.increase_percentage }}%</span>
                </li>
                <li class="display-card">
                    <div class="h-[60px] p-[1px]">
                        <img width="60" height="90"
                             src="https://img.icons8.com/ios-glyphs/90/3AD863/money--v1.png"
                             alt="money--v1"/>
                    </div>
                    <div>
                        <h3 class="text-sm">Payments</h3>
                        <p>Ksh {{ payments?.payments }}</p>
                    </div>
                    <span>Percentage increase/decrece {{ payments?.increase_percentage }}</span>
                </li>
                <li class="display-card">
                    <div class="h-[60px] p-[1px]">
                        <img width="50" height="50"
                             src="https://img.icons8.com/ios/50/0ED3E2/artificial-intelligence.png"
                             alt="artificial-intelligence"/>
                    </div>
                    <div>
                        <h3 class="text-sm">Model Accuracy</h3>
                        <p>{{ model?.model }}%</p>
                    </div>
                    <span>up by {{ model?.increase_percentage }}%</span>
                </li>
            </ul>

            <section class="flex gap-2 mb-[100px]">
                <div class="w-8/12">
                    <h6 class="text-white">Income Summary</h6>
                    <h5 class="text-sm text-gray-200 mb-[20px]">Summary</h5>
                    <div class="bg-gray-500 w-full h-[300px]">

                    </div>
                </div>
                <div class="w-4/12 h-[300px] bg-gray-500 rounded bg-[#373636] p-[18px]">
                    <h6 class="text-white mb-[20px]">Recent Purchases</h6>
                    <ul class="text-white text-sm">
                        <li v-for="i in 5" class=" mb-[10px]">
                            <div class="flex mb-[10px] justify-between">
                                <p>Username</p>
                                <p>200</p>
                            </div>
                            <hr class="border-[1px] border-[grey]">
                        </li>
                    </ul>

                </div>
            </section>

            <section class="mb-[20px]">
                <h6 class="text-white mb-[15px] font-bold">Recent Activity</h6>
                <table class="text-white w-full">
                    <thead class="h-[50px]">
                    <tr class="text-left border-b-[2px] text-sm">
                        <th>Type</th>
                        <th>Initiator</th>
                        <th>Date/Time</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="i in 10" class="border-b h-[70px]">
                        <td>Prediction</td>
                        <td>
                            <div class="h-full w-full">
                                <p class="mb-[5px]">Administrator</p>
                                <p class="text-sm text-gray-300">admin@email.com</p>
                            </div>
                        </td>
                        <td>
                            <div class="h-full w-full">
                                <p class="mb-[5px]">00:00 PM</p>
                                <p class="text-gray-300">00/00/00</p>
                            </div>
                        </td>
                        <td class="w-[40%] pr-[10px] ">
                            <p class=" line-clamp-2">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit. Ab autem cum dolore esse fuga numquam sit voluptatibus. Amet
                                dignissimos dolorem, et inventore molestiae officia perspiciatis possimus
                                praesentium, sed tempora, vero!</p>
                        </td>
                        <td>Active</td>
                        <td>
                            <button class="text-sm py-[3px] px-[10px] bg-red-400 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>

        </div>
    </div>
</template>

<style scoped lang="scss">
table {
    tbody {
        tr {
            border-bottom: 2px solid gray;
            @apply rounded-sm overflow-hidden text-xs;

            td {
                vertical-align: top;
                @apply pt-[10px];
            }

            &:hover {
                cursor: pointer;
                background-color: #575454;
            }
        }
    }
}

.app-card {
    background-image: linear-gradient(20deg, rgb(65 65 65), rgb(73 73 73));
}

.app-card {
    .display-card {
        @apply w-full mx-[10px] h-[140px] rounded-xl p-[10px] shadow-xl;

        & > div:nth-of-type(2) {
            @apply flex justify-between px-[10px] text-lg
        }

        h3, p {
            @apply text-white font-bold;
        }

        span {
            @apply text-gray-300 text-sm p-[20px]
        }

    }

    .display-card:nth-of-type(1) {
        background-image: radial-gradient(
                circle at top right,
                rgb(223, 135, 68) -400%,
                rgb(223, 135, 68) -300%,
                rgb(223, 135, 68) -200%,
                rgb(65, 65, 65)
        );
    }

    .display-card:nth-of-type(2) {
        background-image: radial-gradient(
                circle at top right,
                rgb(68,223,104) -400%,
                rgb(68,223,140) -300%,
                rgb(89,223,68) -200%,
                rgb(65, 65, 65)
        );
    }

    .display-card:nth-of-type(3) {
        background-image: radial-gradient(
                circle at top right,
                rgb(68,158,223) -400%,
                rgb(68,169,223) -300%,
                rgb(68,200,223) -200%,
                rgb(65, 65, 65)
        );
    }
}
</style>
