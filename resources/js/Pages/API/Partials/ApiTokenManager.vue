<template>
    <div>
        <!-- Generate API Token -->
        <quad-form-section @submitted="createApiToken">
            <template #title>
                Create API Token
            </template>

            <template #description>
                API tokens allow third-party services to authenticate with our application on your behalf.
            </template>

            <template #form>
                <!-- Token Name -->
                <div class="col-span-6 sm:col-span-4">
                    <quad-label for="name" value="Name" />
                    <quad-input id="name" type="text" class="mt-1 block w-full" v-model="createApiTokenForm.name" color="yellow" :strength="200" autofocus />
                    <quad-input-error :message="createApiTokenForm.errors.name" class="mt-2" />
                </div>

                <!-- Token Permissions -->
                <div class="col-span-6" v-if="availablePermissions.length > 0">
                    <quad-label for="permissions" value="Permissions" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="permission in availablePermissions" :key="permission">
                            <label class="flex items-center">
                                <quad-checkbox :value="permission" v-model:checked="createApiTokenForm.permissions" color="yellow" :strength="100"/>
                                <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </template>

            <template #actions>
                <quad-action-message :on="createApiTokenForm.recentlySuccessful" class="mr-3">
                    Created.
                </quad-action-message>

                <quad-button :class="{ 'opacity-25': createApiTokenForm.processing }" :disabled="createApiTokenForm.processing" color="yellow" :strength="100"> 
                    Create
                </quad-button>
            </template>
        </quad-form-section>

        <div v-if="tokens.length > 0">
            <quad-section-border />

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <quad-action-section>
                    <template #title>
                        Manage API Tokens
                    </template>

                    <template #description>
                        You may delete any of your existing tokens if they are no longer needed.
                    </template>

                    <!-- API Token List -->
                    <template #content>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between" v-for="token in tokens" :key="token.id">
                                <div>
                                    {{ token.name }}
                                </div>

                                <div class="flex items-center">
                                    <div class="text-sm text-gray-400" v-if="token.last_used_ago">
                                        Last used {{ token.last_used_ago }}
                                    </div>

                                    <button class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                                        @click="manageApiTokenPermissions(token)"
                                        v-if="availablePermissions.length > 0"
                                    >
                                        Permissions
                                    </button>

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" @click="confirmApiTokenDeletion(token)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </quad-action-section>
            </div>
        </div>

        <!-- Token Value Modal -->
        <quad-dialog-modal :show="displayingToken" @close="displayingToken = false">
            <template #title>
                API Token
            </template>

            <template #content>
                <div>
                    Please copy your new API token. For your security, it won't be shown again.
                </div>

                <div class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500" v-if="$page.props.jetstream.flash.token">
                    {{ $page.props.jetstream.flash.token }}
                </div>
            </template>

            <template #footer>
                <quad-button @click="displayingToken = false" color="gray">
                    Close
                </quad-button>
            </template>
        </quad-dialog-modal>

        <!-- API Token Permissions Modal -->
        <quad-dialog-modal :show="managingPermissionsFor" @close="managingPermissionsFor = null">
            <template #title>
                API Token Permissions
            </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="permission in availablePermissions" :key="permission">
                        <label class="flex items-center">
                            <quad-checkbox :value="permission" v-model:checked="updateApiTokenForm.permissions" color="yellow" :strength="100"/>
                            <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
                        </label>
                    </div>
                </div>
            </template>

            <template #footer>
                <quad-button @click="managingPermissionsFor = null" color="gray">
                    Cancel
                </quad-button>

                <quad-button class="ml-3" @click="updateApiToken" :class="{ 'opacity-25': updateApiTokenForm.processing }" :disabled="updateApiTokenForm.processing" color="yellow" :strength="100">
                    Save
                </quad-button>
            </template>
        </quad-dialog-modal>

        <!-- Delete Token Confirmation Modal -->
        <quad-confirmation-modal :show="apiTokenBeingDeleted" @close="apiTokenBeingDeleted = null">
            <template #title>
                Delete API Token
            </template>

            <template #content>
                Are you sure you would like to delete this API token?
            </template>

            <template #footer>
                <quad-button @click="apiTokenBeingDeleted = null" color="gray">
                    Cancel
                </quad-button>

                <quad-button class="ml-3" @click="deleteApiToken" :class="{ 'opacity-25': deleteApiTokenForm.processing }" :disabled="deleteApiTokenForm.processing" color="yellow" :strength="100">
                    Delete
                </quad-button>
            </template>
        </quad-confirmation-modal>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import QuadActionMessage from '@/Components/ActionMessage.vue'
    import QuadActionSection from '@/Components/ActionSection.vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadConfirmationModal from '@/Components/ConfirmationModal.vue'
    import QuadDialogModal from '@/Components/DialogModal.vue'
    import QuadFormSection from '@/Components/FormSection.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadCheckbox from '@/Components/Checkbox.vue'
    import QuadInputError from '@/Components/InputError.vue'
    import QuadLabel from '@/Components/Label.vue'
    import QuadSectionBorder from '@/Components/SectionBorder.vue'

    export default defineComponent({
        components: {
            QuadActionMessage,
            QuadActionSection,
            QuadButton,
            QuadConfirmationModal,
            QuadDialogModal,
            QuadFormSection,
            QuadInput,
            QuadCheckbox,
            QuadInputError,
            QuadLabel,
            QuadSectionBorder,
        },

        props: [
            'tokens',
            'availablePermissions',
            'defaultPermissions',
        ],

        data() {
            return {
                createApiTokenForm: this.$inertia.form({
                    name: '',
                    permissions: this.defaultPermissions,
                }),

                updateApiTokenForm: this.$inertia.form({
                    permissions: []
                }),

                deleteApiTokenForm: this.$inertia.form(),

                displayingToken: false,
                managingPermissionsFor: null,
                apiTokenBeingDeleted: null,
            }
        },

        methods: {
            createApiToken() {
                this.createApiTokenForm.post(route('api-tokens.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.displayingToken = true
                        this.createApiTokenForm.reset()
                    }
                })
            },

            manageApiTokenPermissions(token) {
                this.updateApiTokenForm.permissions = token.abilities

                this.managingPermissionsFor = token
            },

            updateApiToken() {
                this.updateApiTokenForm.put(route('api-tokens.update', this.managingPermissionsFor), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.managingPermissionsFor = null),
                })
            },

            confirmApiTokenDeletion(token) {
                this.apiTokenBeingDeleted = token
            },

            deleteApiToken() {
                this.deleteApiTokenForm.delete(route('api-tokens.destroy', this.apiTokenBeingDeleted), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.apiTokenBeingDeleted = null),
                })
            },
        },
    })
</script>
