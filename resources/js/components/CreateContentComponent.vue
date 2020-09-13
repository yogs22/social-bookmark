<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Create Content</div>

                    <div class="card-body">
                        <form @submit.prevent="processGrab()">
                            <div class="form-group">
                                <label for="url">Masukkan URL (https://www.google.com)</label>
                                <textarea name="url" rows="5" class="form-control" placeholder="Pisahkan dengan enter" v-model="form.url"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-25" :disabled="disabled">Submit</button>
                            <div class="progress mt-4" v-show="progressBar">
                              <div v-bind:class="['progress-bar', success ? 'bg-success' : '']" role="progressbar" v-bind:style="{ width: progressPercent }" v-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100" id="progressBar">{{ progressPercent }}</div>
                            </div>
                        </form>

                        <div class="w-100 alert alert-primary mt-4" v-if="contents.length != 0">
                            <h5>Content Log</h5>
                            <ol style="padding-left: 16px">
                                <li v-for="content in contents">
                                    <a :href="origin + '/' + content.slug" target="_blank" rel="noreferrer">
                                        {{ content.title }}
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    url: ''
                },
                contents: [],
                progressBar: false,
                progress: 0,
                progressPercent: 0,
                success: false,
                disabled: false,
                origin: window.location.origin
            }
        },

        methods: {
            async processGrab() {
                let items = this.form.url.split("\n")
                let total = Math.ceil(100 / items.length)
                let time = 3

                this.progress = 0
                this.progressPercent = 0
                this.success = false
                this.disabled = false
                this.contents = []

                this.progressBar = true
                this.disabled = true

                for (let i = 0; i < items.length; i++) {
                    let date = new Date()
                    date.setHours(date.getHours() + (time * i))
                    date.toLocaleString()

                    var mm = date.getMonth() + 1;
                    var dd = date.getDate();
                    var yy = date.getFullYear();

                    var sc = date.getSeconds();
                    var mt = date.getMinutes();
                    var hr = date.getHours();

                    let published_at = `${yy}-${mm}-${dd} ${hr}:${mt}:${sc}`
                    console.log(published_at)

                    axios.post(`${this.origin}/api/content`, { url: items[i], published_at: published_at })
                    .then((resp) => {
                        this.contents.push(resp.data.payload)
                        this.progress += total;
                        this.progress = Math.round(this.progress)
                        this.progressPercent = `${this.progress}%`
                        if (this.progress >= 100) {
                            this.progress = 100;
                            this.progressPercent = `${this.progress}%`
                            this.success = true
                            this.disabled = false
                        }
                    })
                    .catch((resp) => {
                        console.log(resp)
                    });
                }
            }
        }
    }
</script>
