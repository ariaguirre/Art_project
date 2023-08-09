<template>
  <div>
    <h2>Objects List</h2>
    <ul>
      <li v-for="object in objects" :key="object.objectID">
        {{ object.title }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      objects: [],
    };
  },
  mounted() {
    axios.get('http://localhost:8000/objects')
      .then(response => {
        console.log(response.data)
        this.objects = response.data.objectIDs; // Assuming your API response has an "objectIDs" key
      })
      .catch(error => {
        console.error(error);
      });
  },
};
</script>
