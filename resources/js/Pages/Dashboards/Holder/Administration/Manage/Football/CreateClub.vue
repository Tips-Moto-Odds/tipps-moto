<script setup>



import {computed} from "vue";

const emit = defineEmits(['submitForm','deleteRecord'])
const props = defineProps({
    clubForm:Object
})

function handleSubmit(){
    emit('submitForm')
}

function deleteClub(id){
    emit("deleteRecord",id)
}

const isCreating = computed(() => {
    return props.clubForm.id === ""
})

</script>


<template>
  <div v-if="clubForm" class="form-container none">
      <div class="text-white">
          <form @submit.prevent.stop="handleSubmit">
              <div v-if="clubForm.id" class="app-form-group">
                  <label>ID</label>
                  <input disabled v-model="clubForm.id">
              </div>
              <div class="app-form-group">
                  <label>Name</label>
                  <input v-model="clubForm.name" required>
                  <p class="error">{{clubForm.errors.name}}</p>
              </div>
              <div v-if="clubForm.id && (typeof clubForm.logo) === 'string' " class="mb-[20px]">
                  <div class="w-[150px] h-[150px] bg-white p-2 flex justify-center items-center rounded-md shadow-sm">
                      <img style="max-width: 100%; max-height: 100%; object-fit: contain; object-position: center" :src="'/storage/System/TeamLogos/'+clubForm.logo" alt="" />
                  </div>
              </div>
              <div class="mb-[30px] app-form-group">
                  <label>LOGO</label>
                  <input id="fileInput" type="file" @input="clubForm.logo = $event.target.files[0]" :required="isCreating">
                  <p class="error">{{clubForm.errors.logo}}</p>
              </div>
              <button v-if="clubForm.id === '' || clubForm.id == null" class="form-action-button" type="submit">Save</button>
              <div v-else class="flex justify-center items-center gap-3 w-fit pt-[30px]">
                  <button class="form-action-button" type="submit">Update</button>
                  <button class="form-action-button !bg-red-400" @click.prevent.stop="deleteClub(clubForm.id)">Delete</button>
              </div>
          </form>
      </div>
  </div>
</template>
