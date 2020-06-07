<template>
    <div class="conversation">
      <h4>{{contact ? contact.name : 'Select Contact'}}</h4>
      <MessagesFeed :messages="messages" :contact="contact"/>
      <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
     import MessagesFeed from './MessagesFeed'
     import MessageComposer from './MessageComposer'
   export default{
    props:{
        contact:{
          type: Object,
          default: null
        },
        messages: {
          type: Array,
          default: []
        }
    },
      components: {
        MessagesFeed,
        MessageComposer
      },
      methods :{
        sendMessage(text){
          if(!this.contact){
            return;
          }
          axios.post(`/conversation/send`,{
            contact_id: this.contact.id,
            text: text,
          }).then((response)=>{
            this.$emit('new',response.data);
          })
        }

      }
   }
</script>

<style lang="scss" scoped>
.conversation {
  flex: 5;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  h4 {
    font-size: 17px;
    padding: 10px;
    margin: 0;
    border-bottom: 1px dashed deepskyblue;
}

}
</style>
