<template>
  <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Updated PDF</h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div class="py-0 pb-6">
            <div>
              <!-- <pre class="whitespace-break-spaces">{{data}}</pre> -->
              <form @submit.prevent="()=> alert('going to select layout page')">
                <div class="my-4" v-if="formatedData.personal_informations">
                  <h2 class="mb-2">Personal Informations</h2>
                  <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col" v-for="personalInfo, key in formatedData.personal_informations" :key="key">
                      <label class="text-xs uppercase" :for="key">{{ key }}</label>
                      <input class="text-sm" type="text" :name="key" :id="key" :value="personalInfo">
                    </div>
                  </div>
                </div>

                <div class="my-4" v-if="formatedData.objective">
                  <h2 class="mb-2">Objectives</h2>
                  <div class="flex flex-col">
                    <textarea class="resize-none" name="objective" id="objective" cols="30" rows="5" v-model="formatedData.objective"></textarea>
                  </div>
                </div>

                <div class="my-4" v-if="formatedData.experience">
                  <h2 class="mb-2">Experiences</h2>
                  <div class="grid grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2" v-for="exp, key in formatedData.experience" :key="key">
                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.company">Company</label>
                        <input class="text-sm" type="text" :name="exp.company" :id="exp.company" :value="exp.company">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.role">Role</label>
                        <input class="text-sm" type="text" :name="exp.role" :id="exp.role" :value="exp.role">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.description">Description</label>
                        <textarea class="resize-none" name="description" id="description" cols="30" rows="5" v-model="exp.description"></textarea>
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.technologies">Technologies</label>
                        <input class="text-sm" type="text" :name="exp.technologies" :id="exp.technologies" :value="exp.technologies">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="my-4" v-if="formatedData.education">
                  <h2 class="mb-2">Education</h2>
                  <div class="grid grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2" v-for="exp, key in formatedData.education" :key="key">
                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.school">School</label>
                        <input class="text-sm" type="text" :name="exp.school" :id="exp.school" :value="exp.school">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.degree">Degree</label>
                        <input class="text-sm" type="text" :name="exp.degree" :id="exp.degree" :value="exp.degree">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.start">Start Date</label>
                        <input class="text-sm" type="text" :name="exp.start" :id="exp.start" :value="exp.start">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.end">End Date</label>
                        <input class="text-sm" type="text" :name="exp.end" :id="exp.end" :value="exp.end">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.description">Description</label>
                        <textarea class="resize-none" name="description" id="description" cols="30" rows="5" v-model="exp.description"></textarea>
                      </div>
                      
                    </div>
                  </div>
                </div>

                <div class="my-4" v-if="formatedData.languages">
                  <h2 class="mb-2">Languages</h2>
                  <div class="grid grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2" v-for="exp, key in formatedData.languages" :key="key">
                      <div class="flex flex-col gap-1" v-if="exp.level">
                        <label class="text-xs uppercase" :for="exp.level">Level</label>
                        <input class="text-sm" type="text" :name="exp.level" :id="exp.level" :value="exp.level">
                      </div>

                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.name">Name</label>
                        <input class="text-sm" type="text" :name="exp.name" :id="exp.name" :value="exp.name">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="my-4" v-if="formatedData.skills">
                  <h2 class="mb-2">Skills</h2>
                  <div class="grid grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2" v-for="exp, key in formatedData.skills" :key="key">
                      <div class="flex flex-col gap-1">
                        <label class="text-xs uppercase" :for="exp.name">Name</label>
                        <input class="text-sm" type="text" :name="exp.name" :id="exp.name" :value="exp.name">
                      </div>

                      <div class="flex flex-col gap-1" v-if="exp.level">
                        <label class="text-xs uppercase" :for="exp.level">Level</label>
                        <input class="text-sm" type="text" :name="exp.level" :id="exp.level" :value="exp.level">
                      </div>
                    </div>
                  </div>
                </div>


                <button
                  type="submit"
                  class="text-sm p-2 bg-indigo-200 rounded-md border-2 border-indigo-300 "
                >
                  Select layout
              </button>

              </form>
            </div>
          </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
  import NavLink from '@/Components/NavLink.vue'; 
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  import { onMounted, ref } from 'vue';

  const form = useForm({
    description: ''
  });

  const props = defineProps({
    data: {
      type: Array,
      default: ''
    }
  })
  const formatedData = ref({});

  onMounted(() => {
    formatedData.value = JSON.parse(props.data);
  })  

  
</script>