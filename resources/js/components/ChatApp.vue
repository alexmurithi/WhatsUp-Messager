<template>
    <div class="chatapp">
      <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
      <ContactList :contacts="contacts" @selected="startConversationWith"/>
    </div>

</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';

    export default {
        mounted() {
            Echo.private(`messages.${this.user.id}`)
               .listen('newMessage',(e)=>{
                 this.handleIncoming(e.message);
               })
            axios.get('/contacts')
              .then((res)=>{
                this.contacts =res.data;

              }).catch(error=>{
                console.log(error)
              })
        },

        data(){
          return{
            messages: [],
            contacts: [],
            selectedContact: null
          }
        },
        props: {
          user:{
            required: true,
            type: Object
          },


        },
        components:{
          ContactList,
          Conversation
        },
        methods: {
          startConversationWith(contact){
            axios.get(`/conversation/${contact.id}`)
              .then((response)=>{
                this.messages =response.data;
                console.log(response.data)
                this.selectedContact =contact;
              }).catch(error=>{
                console.log(error)
              })
          },
          saveNewMessage(message){
            this.messages.push(message);
          },

          handleIncoming(message){
            if(this.selectedContact && message.from ==this.selectedContact.id){
              this.saveNewMessage(message);
              return;
            }
              alert(message.text)
          }
        }
    }
</script>

<style lang="scss" scoped>
 .chatapp {
    display: flex
  }
</style>
