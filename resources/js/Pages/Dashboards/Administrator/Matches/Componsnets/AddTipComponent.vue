<script setup>
import {useForm} from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    matchId: {
        type: Number,
        default: null
    },
    tipForm: {
        type: Object,
        default: null
    }
})

function submitTip() {
    props.tipForm.post(route('dashboard.tips.storeTip'), {
        onSuccess: function (data) {
            window.location.reload();
        }
    })
}

function updateTip() {
    props.tipForm.patch(route('dashboard.tips.patchTip',[props.tipForm.tip_id]), {
        onSuccess: function (data) {
            window.location.reload();
        }
    })
}

</script>
<template>
    <section class="p-[10px]">
        <div v-if="tipForm.tip_id" class="flex w-full ">
            <label class="text-white mb-[20px]">ID : </label>
            <p class="text-white text-end"> {{tipForm.tip_id}}</p>
            <hr class="border-gray-200"/>
        </div>
        <div>
            <label class="block text-white mb-[20px]">Tip Type</label>
            <select v-model="tipForm.tip_type" class="rounded w-100">
                <option value="1-X-2">1-X-2</option>
                <option value="1X-2X">1X-2X</option>
                <option value="GG-NG">GG-NG</option>
                <option value="Over">Over</option>
                <option value="Under">Under</option>
            </select>
            <hr class="border-gray-200"/>
        </div>
        <div>
            <label class="block text-white mb-[20px]">Prediction</label>
            <select class="rounded w-100" v-model="tipForm.prediction">
                <option v-if="tipForm.tip_type === '1-X-2' " value="Home Win">Home Win</option>
                <option v-if="tipForm.tip_type === '1-X-2' " value="Away Win">Away Win</option>
                <option v-if="tipForm.tip_type === '1-X-2' " value="Draw">Draw</option>
                <option v-if="tipForm.tip_type === '1X_X2_12' " value="Home Win/Draw">Home Win/Draw</option>
                <option v-if="tipForm.tip_type === '1X_X2_12' " value="Away Win/Draw">Away Win/Draw</option>
                <option v-if="tipForm.tip_type === '1X_X2_12' " value="Home Win/Away Win">Home Win/Away Win</option>
                <option v-if="tipForm.tip_type === 'GG-NG' " value="GG">GG</option>
                <option v-if="tipForm.tip_type === 'GG-NG' " value="NG">NG</option>
                <option v-if="tipForm.tip_type === 'Over' " value="OVER 1.5">OVER 1.5</option>
                <option v-if="tipForm.tip_type === 'Over' " value="OVER 2.5">OVER 2.5</option>
                <option v-if="tipForm.tip_type === 'Over' " value="OVER 3.5">OVER 3.5</option>
                <option v-if="tipForm.tip_type === 'Over' " value="OVER 4.5">OVER 4.5</option>
                <option v-if="tipForm.tip_type === 'Over' " value="OVER 5.5">OVER 5.5</option>
                <option v-if="tipForm.tip_type === 'Under' " value="UNDER 1.5">UNDER 1.5</option>
                <option v-if="tipForm.tip_type === 'Under' " value="UNDER 2.5">UNDER 2.5</option>
                <option v-if="tipForm.tip_type === 'Under' " value="UNDER 3.5">UNDER 3.5</option>
                <option v-if="tipForm.tip_type === 'Under' " value="UNDER 4.5">UNDER 4.5</option>
                <option v-if="tipForm.tip_type === 'Under' " value="UNDER 5.5">UNDER 5.5</option>
            </select>
            <hr class="border-gray-200"/>
        </div>
        <div>
            <label class="block text-white mb-[20px]">Risk Level</label>
            <select class="rounded w-100" v-model="tipForm.risk_level">
                <option value="Min">Min</option>
                <option value="Average">Average</option>
                <option value="Max">Max</option>
            </select>
            <hr class="border-gray-200"/>
        </div>
        <div>
            <label class="block text-white mb-[20px]">Winning Status</label>
            <select class="rounded w-100" v-model="tipForm.winning_status">
                <option value="Pending">Pending</option>
                <option value="Won">Won</option>
                <option value="Lost">Lost</option>
                <option value="Canceled">Canceled</option>
            </select>
            <hr class="border-gray-200"/>
        </div>
        <div class="">
            <label class="text-white mb-[5px]">Mark as Free</label>
            <input type="checkbox" class="mx-[20px]" v-model="tipForm.mark_as_free"></input>
            <hr class="border-gray-200"/>
        </div>
        <div>
            <button v-if="tipForm.tip_id" class="action-button text-white w-100 block bg-orange-500 hover:bg-orange-500/50 rounded" @click.prevent="updateTip">Update</button>
            <button v-else class="action-button text-white w-100 block bg-blue-500 hover:bg-blue-500/50 rounded" @click.prevent="submitTip">Add</button>
        </div>
    </section>
</template>
