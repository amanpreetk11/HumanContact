<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    approved: false,
});

const submit = () => {
    form.post(route("attendees.add"), {
        onFinish: () =>
            form.reset("first_name", "last_name", "email", "approved"),
    });
};
</script>

<template>
    <Head title="Attendees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Attendee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit">
                    <div class="flex justify-end my-4">
                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Save
                        </PrimaryButton>
                    </div>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5"
                    >
                        <div class="input">
                            <InputLabel for="first_name" value="First Name" />

                            <TextInput
                                id="first_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.first_name"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.first_name"
                            />
                        </div>
                        <div class="input">
                            <InputLabel for="last_name" value="Last Name" />

                            <TextInput
                                id="last_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.last_name"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.last_name"
                            />
                        </div>
                        <div class="input">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.email"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>
                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox
                                    name="approved"
                                    v-model:checked="form.approved"
                                />
                                <span class="ml-2 text-sm text-gray-600"
                                    >Approved</span
                                >
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<!-- <script>
import axios from "axios";

export default {
    name: "create_attendee",
    data() {
        return {
            attendee: {
                first_name: "",
                last_name: "",
                email: "",
                approved: false,
                member_since: "",
            },
            errors: "",
        };
    },
    methods: {
        async add() {
            await axios
                .post("/api/attendees/create", this.attendee)
                .then((response) => {
                    console.log(response);
                    this.$router.push({ name: "attendees" });
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script> -->
