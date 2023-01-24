<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    attendeesList: Array,
});

const attendee = usePage().props.attendeesList;

const form = useForm({
    first_name: attendee.first_name,
    last_name: attendee.last_name,
    email: attendee.email,
    approved: attendee.approved,
});
</script>

<template>
    <Head title="Attendees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Attendees
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end my-4">
                    <a
                        :href="route('attendees.create')"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Add
                    </a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="table-responsive">
                        <div class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Approved</th>
                                    <th>Member Since</th>
                                </tr>
                            </thead>
                            <tbody v-if="attendeesList.length > 0">
                                <tr
                                    v-for="(attendee, key) in attendeesList"
                                    :key="key"
                                >
                                    <td>{{ attendee.first_name }}</td>
                                    <td>{{ attendee.last_name }}</td>
                                    <td>{{ attendee.email }}</td>
                                    <td>{{ attendee.approved }}</td>
                                    <td>{{ attendee.member_since }}</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="5" align="center">
                                        No Attendees Found.
                                    </td>
                                </tr>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<!-- <script>
import axios from "axios";

export default {
    name: "attendees",
    data() {
        return {
            attendeesList: [],
        };
    },
    mounted() {
        this.getAttendees();
    },
    methods: {
        async getAttendees() {
            await axios
                .get("/api/attendees")
                .then((response) => {
                    console.log(response);
                    return false;
                    this.attendeesList = response.data.attendees;
                })
                .catch((error) => {
                    console.log(error.response);
                    this.attendeesList = [];
                });
        },
    },
};
</script> -->
