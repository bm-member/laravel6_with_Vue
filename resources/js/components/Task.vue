<template>
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-12">
        <button class="btn btn-primary float-right" @click="newTask()">Create</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Task Name</label>
        <div class="form-group">
          <input type="text" class="form-control" v-model="task.name" />
        </div>
        <button class="btn btn-primary" v-if="isAdd" @click="addTask()">Add</button>
        <button class="btn btn-success" v-else @click="updateTask()">Update</button>
      </div>
      <div class="col-md-8">
        <table class="table">
          <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Actions</th>
          </tr>
          <tr v-for="task in tasks" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.name }}</td>
            <td>
              <button class="btn btn-success" @click="editTask(task)">Edit</button>
              <button class="btn btn-danger" @click="deleteTask(task.id)">Del</button>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "http://localhost/laravel_vue/public/api/task",
      task: {
        id: "",
        name: ""
      },
      tasks: [],
      isAdd: true
    };
  },
  methods: {
    getAllTask() {
      axios
        .get(this.url)
        .then(res => (this.tasks = res.data))
        .catch(err => console.log(err));
    },
    addTask() {
      if(this.task.name.trim() !== '') {
        axios
        .post(this.url, { name: this.task.name })
        .then(res => {
          this.getAllTask();
          this.task = "";
          // Toast Message
          Toast.fire({
            icon: "success",
            title: "A Post added."
          });

        })
        .catch(err => console.log(err));
      }
    },
    newTask() {
      this.task = "";
      this.isAdd = true;
    },
    editTask(task) {
      this.task.id = task.id;
      this.task.name = task.name;
      this.isAdd = false;
    },
    updateTask() {
      let updateUrl = this.url + "/" + this.task.id;
      axios
        .put(updateUrl, { name: this.task.name })
        .then(res => {
          this.getAllTask();
          this.task = "";
          this.isAdd = true;
        })
        .catch(err => console.log(err));
    },
    deleteTask(id) {
      let delUrl = this.url + "/" + id;
      axios
        .delete(delUrl)
        .then(res => this.getAllTask())
        .catch(err => console.log(err));
    }
  },
  created() {
    this.getAllTask();
  }
};
</script>
