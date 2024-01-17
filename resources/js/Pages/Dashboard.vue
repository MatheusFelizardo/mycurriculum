<script setup>
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
const file = ref(null);
const filePreview = ref(null);
const errorMessage = ref(null);
const maxAllowedSize = 5 * 1024 * 1024;
const form = useForm({
  cv: null
})

onMounted(()=> {
  const fileContainer = document.getElementById("file-container");

  fileContainer.addEventListener("drop", (e) => {
    e.preventDefault();
    errorMessage.value = null;
    resetFileContainerStyle()
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      

      if (files[0].size > maxAllowedSize) {
        errorMessage.value = "File is too large. Max size is 5MB.";
        return;
      }

      file.value = files[0];
      filePreview.value = URL.createObjectURL(files[0]);
    }
  });

  fileContainer.addEventListener("dragover", (e) => {
    e.preventDefault();
    fileContainer.classList.add("border-2");
    fileContainer.classList.add("border-dashed");
    fileContainer.classList.add("rounded-lg");
    fileContainer.classList.add("border-indigo-600");

  });

  fileContainer.addEventListener('dragleave', () => {
    resetFileContainerStyle()
  });

  const resetFileContainerStyle = () => {
    fileContainer.classList.remove("border-2");
    fileContainer.classList.remove("border-dashed");
    fileContainer.classList.remove("rounded-lg");
    fileContainer.classList.remove("border-indigo-600");
  };
})

const handleFile = (e) => {
  errorMessage.value = null;

  if (e.target.files[0].size > maxAllowedSize) {
    errorMessage.value = "File is too large. Max size is 5MB.";
    return;
  }

  file.value = e.target.files[0];
  filePreview.value = URL.createObjectURL(file.value);
};

const submitCV = () => {
  if (!file.value) {
    errorMessage.value = "Please upload a file.";
    return;
  }

  const formData = new FormData();
  formData.append("file", file.value);
  form.cv = file.value;

  form.post(route('pdf.read'), {
    onFinish: () => {
      form.reset('cv')
      file.value = null;
      filePreview.value = null;
      errorMessage.value = null;
    },
  });
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="submitCV">
          <div class="space-y-12">
            <div class="pb-12">
              <div
                class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
              >
                <div class="col-span-full">
                  <span
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Upload your resume</span
                  >
                  <div
                    
                    class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                  >
                    <div class="text-center">
                      <svg
                        class="mx-auto h-12 w-12 text-gray-300"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <div class="mt-4 flex text-sm leading-6 text-gray-600">
                        <label
                          class="absolute w-full h-full left-0 top-0 z-10 cursor-pointer"
                          for="file-upload"
                          id="file-container"
                        ></label>
                        <label
                          for="file-upload"
                          class="relative px-2 cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                        >
                          <span>Upload a file</span>
                        </label>
                        <p class="pl-1">or drag and drop</p>
                        <input
                          @change="handleFile"
                          id="file-upload"
                          name="file-upload"
                          type="file"
                          class="sr-only"
                          accept=".pdf"
                        />
                      </div>
                      <p class="text-xs leading-5 text-gray-600">
                        File types accepted: PDF. <br/> Max file size: 5MB
                      </p>
                    </div>
                  </div>
                  <div class="w-full mt-6 flex items-center justify-between gap-x-6">
                    <span class="text-sm">
                      <span v-if="errorMessage" class="text-red-500">
                        {{ errorMessage }}
                      </span>

                      <a
                        v-if="filePreview"
                        :href="filePreview"
                        target="_blank"
                        class="text-sm text-indigo-600 font-semibold"
                        >Preview {{ file.name }}</a
                      >
                    </span>

                 
        
                    <button
                     :disabled="!file || errorMessage"
                      type="submit"
                      class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                      :class="{'opacity-50 cursor-not-allowed': !file || errorMessage}"
                    >
                      Continue
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
