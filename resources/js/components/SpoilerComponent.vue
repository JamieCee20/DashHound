<template>
    <div>
        <slot v-if="seen"></slot>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return{
                seen: false
            }
        },
        methods: {
            showAlert() {
                this.$fire({
                title: '<strong>This post may contain spoilers</strong>',
                icon: 'warning',
                html:
                    'Do you wish to proceed?',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText:
                    '<button class="btn btn-primary justify-content-center">Yes</button>',
                confirmButtonAriaLabel: 'Yes',
                cancelButtonText:
                    '<button class="btn btn-danger justify-content-center">No</button>',
                cancelButtonAriaLabel: 'No'
                }).then(r => {
                    if(r.value == undefined) {
                        window.location.href = '/posts';
                    } else if(r.value == true) {
                        this.seen = true;
                    }
                });
            },
        },
        created: function() {
            this.showAlert()
        }, 
    };
</script>
