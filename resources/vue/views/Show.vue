<template>
    <table>
        <thead>
            <tr>
                <th>Date</th>

            </tr>
        </thead>
        <tbody>
            <table>
                <tr
                    v-for="(item,index) in result"
                    key="index"
                >
                    <td>{{ index }}</td>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
                    <tr v-for="i in item" :key="i.id">
                        <td>{{ i.id }}</td>
                        <td>{{ i.name }}</td>
                        <td>{{ i.age }}</td>
                    </tr>
                </tr>
            </table>
        </tbody>
    </table>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const array = ref([
    {
        id: 1, date: 1590998400000, name: 'John', age: 20,
    },
    {
        id: 2, date: 1550998600000, name: 'Jane', age: 22,
    },
    {
        id: 3, date: 1550998800000, name: 'Jack', age: 24,
    },
    // ... more than 1000 entries
]);

const result = array.value.reduce((acc, curr) => {
    const dateString = new Date(curr.date).toISOString().substring(0, 10);
    if (!acc[dateString]) {
        acc[dateString] = [];
    }
    acc[dateString].push(curr);
    return acc;
}, {});

for (const date in result) {
    console.log(`${date}:`);
    result[date].forEach((obj) => {
        console.log(`  id: ${obj.id}, name: ${obj.name}, age: ${obj.age}`);
    });
}
</script>
