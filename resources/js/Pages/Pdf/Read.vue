<template>
  <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reading your CV</h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div class="py-0 pb-6">
            <div>
                <pre class="whitespace-break-spaces">{{gptResponse}}</pre>
            </div>
          </div>

          <div>
            <p>Paste the job description:</p>
            <form @submit.prevent="submitJobDescription">
              <input type="hidden" name="cv" :value="gptResponse">
              <textarea v-model="form.description" class="w-full resize-none" name="description" id="description" cols="30" rows="10">
              </textarea>

              <button
                :disabled="form.processing || form.description.length < 1"
                type="submit"
                class="p-2 bg-gray-200 rounded-md border-2 border-gray-300 "
                :class="{'bg-gray-300 cursor-not-allowed': form.processing || form.description.length < 1}"
              >
                Submit
            </button>
            </form>
          </div>
  
        </div>

        
    
    </AuthenticatedLayout>
</template>

<script setup>
  import NavLink from '@/Components/NavLink.vue'; 
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  import { onMounted } from 'vue';

  const form = useForm({
    description: '',
    cv: ''
  });

  const props = defineProps({
    data: {
      type: String,
      default: ''
    },
    gptResponse: {
      type: String,
      default: ''
    }
  })

  const submitJobDescription = () => {
    form.cv = props.gptResponse;
    console.log(form.cv)
    form.post(route('pdf.update'), {
      onFinish: () => form.reset('description'),
    });
  }

  
</script>