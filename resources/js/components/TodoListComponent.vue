<template>
    <div class="container">
        <form @submit.prevent="createTask()">
            <div class="d-flex">
                <input v-model="task" type="text" class="form-control mr-1" placeholder="Add todo here">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>

        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Todo</th>
                <th scope="col">Done</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks">
                <th scope="row">{{ task.id }}</th>
                <td><input type="text" v-model="task.text" style="background:#f8fafc;border:0;outline:none;width:100%" @keydown.enter="updateTask(task)"></td>
                <td><input type="checkbox" :checked="getToggle(task)" @click="toggle(task)"></td>
                <td><button class="btn btn-danger btn-sm" @click="deleteTask(task)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                task: '',
            }
        },

        created() {
            this.getTasks();
        },

        methods: {
            getTasks() {
                return axios.get('/task')
                    .then(response => {
                        this.tasks = response.data;
                    });
            },

            createTask() {
                axios.post('/task', {
                    text: this.task
                }).then(response => {
                    this.getTasks();
                    this.clearForm();
                });
            },

            updateTask(task) {
                axios.patch('/task/' + task.id, {
                    text: task.text
                });
            },

            deleteTask(task) {
                axios.delete('/task/' + task.id)
                    .then(response => {
                        this.getTasks();
                    });
            },

            toggle(task) {
                axios.patch('/task/' + task.id, {
                    done: task.done
                });
            },

            getToggle(task) {
                if (task.done) return true;
            },

            clearForm() {
                this.task = '';
            }
        }
    }
</script>
