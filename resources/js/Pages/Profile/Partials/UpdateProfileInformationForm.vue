<template>
    <quad-form-section @submitted="updateProfileInformation">
        <template #title>
            Profil Informationen
        </template>

        <template #description>
            Aktualisieren Sie die Profilinformationen und die E-Mail-Adresse Ihres Kontos.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <quad-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          :style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <quad-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto" color="gray">
                    Select A New Photo
                </quad-button>

                <quad-button type="button" class="mt-2" @click.prevent="deletePhoto" v-if="user.profile_photo_path" color="gray">
                    Remove Photo
                </quad-button>

                <quad-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <quad-label for="name" value="Name" />
                <quad-input id="namw" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" color="yellow" :strength="200" />
                <quad-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <quad-label for="email" value="E-Mail" />
                <quad-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" color="yellow" :strength="200" />
                <quad-input-error :message="form.errors.email" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <quad-action-message :on="form.recentlySuccessful" class="mr-3">
                Gespeichert.
            </quad-action-message>

            <quad-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" color="yellow" :strength="100">
                Speichern
            </quad-button>
        </template>
    </quad-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import QuadButton from '@/Components/Button.vue'
    import QuadFormSection from '@/Components/FormSection.vue'
    import QuadInput from '@/Components/Input.vue'
    import QuadInputError from '@/Components/InputError.vue'
    import QuadLabel from '@/Components/Label.vue'
    import QuadActionMessage from '@/Components/ActionMessage.vue'
    export default defineComponent({
        components: {
            QuadActionMessage,
            QuadButton,
            QuadFormSection,
            QuadInput,
            QuadInputError,
            QuadLabel,
        },
        props: ['user'],
        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.user.name,
                    email: this.user.email,
                    photo: null,
                }),
                photoPreview: null,
            }
        },
        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }
                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => (this.clearPhotoFileInput()),
                });
            },
            selectNewPhoto() {
                this.$refs.photo.click();
            },
            updatePhotoPreview() {
                const photo = this.$refs.photo.files[0];
                if (! photo) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(photo);
            },
            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.photoPreview = null;
                        this.clearPhotoFileInput();
                    },
                });
            },
            clearPhotoFileInput() {
                if (this.$refs.photo?.value) {
                    this.$refs.photo.value = null;
                }
            },
        },
    })
</script>