<template >
  <div class="composer">
     <textarea v-model="message" @keydown.enter="send" placeholder="message"></textarea>
  </div>
</template>

<script>
  export default{
     data(){
       return{
         message: ''
       }
     },
     methods: {
        send(e){
          e.preventDefault();
          if(this.message ===''){
            return;
          }
          this.$emit('send',this.message);
          this.message =''
        }
     }
  }
</script>

<style lang="scss" scoped>
   .composer textarea{
    width: 96%;
    resize: none;
    border-radius: 5px;
    border: 1px solid deepskyblue;
    margin: 10px;
    padding: 6px;
   }
</style>
