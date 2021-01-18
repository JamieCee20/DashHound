<template>
    <div class="account">

        <span v-if="this.privacy == false">Public</span>
        <span v-else-if="this.privacy == true">Private</span>

        <label class="switch">
                <input type="checkbox" @click="privacy = !privacy" v-if="privacy == false">
                <span class="slider round" v-if="privacy == false"></span>

                <input type="checkbox" @click="privacy = !privacy" v-if="privacy == true" checked>
                <span class="slider round" v-if="privacy == true"></span>
        </label>
        
        <!-- <input type="button" value="Click Me" @click="privacy = !privacy"> -->
    </div>
</template>

<script>
    import Vue from 'vue';
    import axios from 'axios';

    export default {
        mounted() {
            console.log("Component Mounted.")
        },
        props: ['propsUserid', 'propsCurrent'],
        data: function() {
            return {
                privacy: this.propsCurrent === 1 ? true : false,
                
            }
        },
        watch: {
            privacy: function(val) {
                console.log(`new value ${this.propsUserid} with ${this.privacy} and current is ${this.propsCurrent}`);
                let url = '/profile/privacy/' + this.propsUserid;
                console.log(url);
                axios.post(url, {
                    privateToggle: this.privacy,
                    userId: this.propsUserid, 
                })
                .then((res) => {
                    console.log("Success");
                })
                .catch((error) => {
                    console.log(`${error}`)
                });
            }
        }
    }
</script>

<style scoped>
.switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 16px;
  left: 1px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>