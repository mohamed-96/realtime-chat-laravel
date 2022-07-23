
<template>
  <!-- <div class="row">
    <div class="col-8">
      <div class="card card-default">
        <div class="card-header">Messages</div>
        <div class="card-body p-0">
          <ul class="list-unstyled" style="height: 300px; overflow-y: scroll"  v-chat-scroll>
            <li class="p-2" v-for="(message, index) in messages" :key="index">
              <strong>{{ message.user.name }}</strong>
              {{ message.message }}
            </li>
          </ul>
        </div>

        <input
          @keydown="sendTypingEvent"
          @keyup.enter="sendMessage"
          v-model="newMessage"
          type="text"
          name="message"
          placeholder="Enter your message..."
          class="form-control"
        />
      </div>
      <span class="text-muted" v-if="activeUser"
        >{{ activeUser.name }} is typing...</span
      >
    </div>

    <div class="col-4">
      <div class="card card-default">
        <div class="card-header">Active Users</div>
        <div class="card-body">
          <ul>
            <li class="py-2" v-for="(user, index) in users" :key="index">
              {{ user.name }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div> -->
  <div class="main">
    <div class="containe">
      <div class="messaging">
        <div class="inbox_msg">
          <div class="inbox_people">
            <div class="headind_srch">
              <div class="recent_heading">
                <h4>Recent</h4>
              </div>
              <div class="srch_bar">
                <div class="stylish-input-group">
                  <input type="text" class="search-bar" placeholder="Search" />
                  <span class="input-group-addon">
                    <button type="button">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
            <!-- active_chat -->
            <div class="inbox_chat">
              <div
                class="chat_list"
                v-for="(user, index) in users"
                :key="index"
              >
                <div class="chat_people" @click="fetchMessages(user)">
                  <div class="chat_img">
                    <img
                      src="https://ptetutorials.com/images/user-profile.png"
                      alt="sunil"
                    />
                  </div>
                  <div class="chat_ib">
                    <h5>
                      {{ user.name }} <span class="chat_date">Dec 25</span>
                    </h5>
                    <p>
                      Test, which is a new approach to have all solutions
                      astrology under one roof.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mesgs">
            <div class="msg_history">
              <div v-for="(chat, index) in chat_list" :key="index">
                <div v-if="chat.sender_id != auth_user.id">
                  <div class="incoming_msg">
                    <div class="incoming_msg_img">
                      <img
                        src="https://ptetutorials.com/images/user-profile.png"
                        alt="sunil"
                      />
                    </div>
                    <div class="received_msg">
                      <div class="received_withd_msg">
                        <p>
                          {{ chat.message }}
                        </p>
                        <span class="time_date">
                          {{
                            moment(chat.created_at).format("DD-MM-YYYY")
                          }}</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else class="outgoing_msg">
                  <div class="sent_msg">
                    <p>
                      {{ chat.message }}
                    </p>
                    <span class="time_date">{{
                      moment(chat.created_at).format("DD-MM-YYYY")
                    }}</span>
                  </div>
                </div>
              </div>
              <span class="text-muted" v-if="activeUser"> is typing... </span>
            </div>
            <div class="type_msg">
              <div class="input_msg_write">
                <input
                  @keydown="sendTypingEvent"
                  @keyup.enter="sendMessage"
                  v-model="newMessage"
                  type="text"
                  class="write_msg"
                  placeholder="Type a message"
                />
                <button class="msg_send_btn" type="button" @click="sendMessage">
                  <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.containe {
  max-width: 1170px;
  margin: auto;
  margin-top: -10px;
}
img {
  max-width: 100%;
}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%;
  border-right: 1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
  height: 564px;
}
.top_spac {
  margin: 20px 0 0;
}

.recent_heading {
  float: left;
  width: 40%;
}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch {
  padding: 10px 29px 10px 20px;
  overflow: hidden;
  border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input {
  border: 1px solid #cdcdcd;
  border-width: 0 0 1px 0;
  width: 80%;
  padding: 2px 0 4px 6px;
  background: none;
}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon {
  margin: 0 0 0 -27px;
}

.chat_ib h5 {
  font-size: 15px;
  color: #464646;
  margin: 0 0 8px 0;
}
.chat_ib h5 span {
  font-size: 13px;
  float: right;
}
.chat_ib p {
  font-size: 14px;
  color: #989898;
  margin: auto;
}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people {
  overflow: hidden;
  clear: both;
}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat {
  overflow-y: scroll;
  height: 517px;
}

.active_chat {
  background: #ebebeb;
}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
}
.received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg {
  width: 57%;
}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

.sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0;
  color: #fff;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.outgoing_msg {
  overflow: hidden;
  margin: 26px 0 26px;
}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative;
}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging {
  padding: 0;
}
.msg_history {
  height: 482px;
  overflow-y: auto;
}
</style>

<script>
var moment = require("moment");
export default {
  props: ["auth_user"],
  data() {
    return {
      moment: moment,

      //   messages: [],
      //   newMessage: "",
      //   users: [],
      //   activeUser: false,
      //   typingTimer: false,

      newMessage: "",
      users: [],
      reciver_user: {},
      sender_user: {},
      typing_user: {},
      activeUser: false,
      chat_list: [],
      online: [],
    };
  },
  created() {
    // this.fetchMessages();
    this.subscribe();
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      axios.get("users").then((response) => {
        this.users = response.data;
        // this.fetchMessages(this.users[0]);
      });
    },
    fetchMessages(user) {
      axios
        .get("messages/" + this.auth_user.id + "/" + user.id)
        .then((response) => {
            this.chat_list = [];
          this.chat_list = response.data;
          this.reciver_user = user;
          console.log(this.chat_list);
        });
    },

    sendMessage() {
      let msg = {
        sender_id: this.auth_user.id,
        reciver_id: this.reciver_user.id,
        message: this.newMessage,
      };
      this.chat_list.push(msg);
      axios.post("messages",[  msg ]);
      this.newMessage = "";
    },
    sendTypingEvent() {
      Echo.join("chat").whisper("typing", this.auth_user);
    },
    subscribe() {
      Echo.join("chat")
        .listen("MessageEvent", (event) => {

          this.chat_list.push(event.message);
        })
        .here((user) => {
          //   this.users = user;
        })
        .joining((user) => {
          //   this.users.push(user);
        })
        .leaving((user) => {
          //   this.users = this.users.filter((u) => u.id != user.id);
        })
        .listenForWhisper("typing", (user) => {
          if (user.id == this.reciver_user.id) {
            this.activeUser = user;
            if (this.typingTimer) {
              clearTimeout(this.typingTimer);
            }
            this.typingTimer = setTimeout(() => {
              this.activeUser = false;
            }, 500);
          }
        });
    },
  },
};
</script>
