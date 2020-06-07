<template>
    <div class="contact-list">
      <ul>
        <li v-for="contact in sortedContacts" :key="contact.id" @click="selectedContact(contact)" :class="{ 'selected' : contact === selected}">
          <div class="avatar">
            <img :src="contact.profile_image" :alt="contact.name">
          </div>
          <div class="contact">
            <p class="name text-dark">{{contact.name}}</p>
            <p class="email text-info">{{contact.email}}</p>
            <span v-if="contact.unread" class="unread">{{contact.unread}}</span>
          </div>
        </li>
      </ul>
    </div>
</template>

<script>
   export default{
     props: {
       contacts: {
         type: Array,
         default: []
       }
     },
     data(){
       return{
         selected: this.contacts.length ? this.contacts[0] : null
       }
     },
     methods: {
       selectedContact(contact){
         this.selected =contact;
         this.$emit('selected',contact);
       }
     },
     computed:{
       sortedContacts(){
         return _.sortBy(this.contacts,[(contact)=>{
           if(contact ==this.selected){
             return Infinity;
           }
           return contact.unread;
         }]).reverse()
       }
     }
   }
</script>

<style lang="scss" scoped>
.contact-list {
  flex: 3;
  max-height:600px;
  overflow:scroll;
  border-left: 1px solid #ddd;

   ul{
     list-style-type:none;
     padding-left:0;

     li{
       display:flex;
       padding:2px;
       border-bottom:1px solid #aaa;
       height:80px;
       position:relative;
       cursor:pointer;

       &.selected{
         background:ghostwhite;
       }

       .avatar{
         flex:1;
         display:flex;
         align-items:center;

         img{
           width:35px;
           border-radius:50%;
           margin:0 auto;
         }
       }
       .contact {
         display: flex;
         flex: 3;
         font-size: 10px;
         flex-direction: column;
         justify-content: center;
         overflow: hidden;
          p{
            margin:0;
            &.name{
              font-weight:bold;
            }
          }

          span.unread {
            position: absolute;
            right: 15px;
            top: 20px;
            background: green;
            color: white;
            font-weight: bold;
            min-width: 20px;
            justify-content: center;
            align-items: center;
            display: flex;
            min-height: 20px;
            border-radius: 5px;
          }
       }
     }
   }
}
</style>
