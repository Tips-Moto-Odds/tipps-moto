<!--suppress JSVoidFunctionReturnValueUsed -->
<script setup>
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    clubs:Object
})

const clubForm = useForm({
    id:"",
    name:"",
    logo:""
})

const selected = useForm({
    id:"",
    name:"",
    logo:""
})

function addNewPage(){
    clubForm.reset()

    $('#fileInput').val(null)
}

async function handleSearch(value){
    try {
        const response = axios.post(route('searchClub'),{term:value})

        console.log(response)
    }catch (error){
        console.log(error.message)
    }
}

// async function handleSubmit(){
//     try{
//         await clubForm.post(route('upsertClub'));
//         clubForm.reset()
//         alert("Club added Successfully...")
//     }catch (error){
//         console.log(error)
//     }
// }

function selectTeam(team){
    //get the team that has the same id as team
    const filteredClubs = props.clubs.filter(club => club.id === team);

    if(filteredClubs.length > 0){
        clubForm.reset()
        $('#fileInput').val(null)


        clubForm.id = filteredClubs[0].id
        clubForm.name = filteredClubs[0].name
        clubForm.logo = filteredClubs[0].logo
    }else {
        clubForm.reset()
        $('#fileInput').val(null)
    }


}

async function deleteRecord(id){
    try {
        const {status} = await axios.delete(route('deleteClub', {club: id}))
        alert("Deleted Successfully")
        //reload the page
        window.location.reload();

    }catch (error){
        console.log(error)
    }
}

</script>

<template>
    <DashboardLayout title="FootBall" page-heading="Teams">
        <div class="flex gap-2.5 px-[20px] mb-[20px]">
            <button @click.prevent.stop="addNewPage" class="rounded px-[10px] py-[10px] bg-gray-500 text-white">Add New</button>
        </div>
        <div class="w-[98%] mx-auto text-white flex gap-3" >
            <ClubList :clubs @handle-search="handleSearch" @selectTeam="selectTeam"></ClubList>
            <div class="app-panel w-full">
                <div class="app-panel-heading">
                    <h1>Add Team</h1>
<!--                    <CreateClub :clubForm="clubForm" @submitForm="handleSubmit" @deleteRecord="deleteRecord"/>-->
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

