<template>
  <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Updated PDF</h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div class="py-12">
            <p>This is the updated resume:</p>
            <div>

              <pre class="whitespace-break-spaces">{{data}}</pre>
            </div>
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
    description: ''
  });

  const props = defineProps({
    data: {
      type: Array,
      default: ''
    }
  })

  onMounted(() => {
    console.log(props.data);
  })  

  
</script>