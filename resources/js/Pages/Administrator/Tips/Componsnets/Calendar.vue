<script setup>
import { ref } from "vue";

// Variables for current date, highlighted date, and calendar days
const today = new Date();
const selectedDate = ref(null);

const currentMonth = ref(today.toLocaleString("default", { month: "long" }));
const currentYear = ref(today.getFullYear());
const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const daysInMonth = ref([...Array(getDaysInMonth()).keys()].map(i => i + 1));
const blankDays = ref([...Array(getStartOfMonth()).keys()]);

function getStartOfMonth() {
  return new Date(currentYear.value, today.getMonth(), 1).getDay();
}

function getDaysInMonth() {
  return new Date(currentYear.value, today.getMonth() + 1, 0).getDate();
}

// Date highlight logic
function isHighlighted(date) {
  return selectedDate.value && selectedDate.value.getDate() === date;
}

function selectDate(date) {
  selectedDate.value = new Date(currentYear.value, today.getMonth(), date);
}

// Calendar navigation
function prevMonth() {
  today.setMonth(today.getMonth() - 1);
  updateCalendar();
}

function nextMonth() {
  today.setMonth(today.getMonth() + 1);
  updateCalendar();
}

function updateCalendar() {
  currentMonth.value = today.toLocaleString("default", { month: "long" });
  currentYear.value = today.getFullYear();
  daysInMonth.value = [...Array(getDaysInMonth()).keys()].map(i => i + 1);
  blankDays.value = [...Array(getStartOfMonth()).keys()];
}
</script>

<template>
  <div class="calendar">
    <div class="month">
      <button @click="prevMonth">&#9664;</button>
      <h3>{{ currentMonth }} {{ currentYear }}</h3>
      <button @click="nextMonth">&#9654;</button>
    </div>
    <div class="days">
      <div v-for="day in days" :key="day" class="day-name">{{ day }}</div>
      <div v-for="date in blankDays" :key="date" class="empty-day"></div>
      <div
          v-for="date in daysInMonth"
          :key="date"
          :class="['day', { 'highlighted': isHighlighted(date) }]"
          @click="selectDate(date)"
      >
        {{ date }}
      </div>
    </div>
  </div>
</template>

<style scoped>
.calendar {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 300px;
}
.month {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}
.days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 10px;
}
.day, .day-name {
  text-align: center;
  padding: 10px;
  border-radius: 50%;
}
.day {
  cursor: pointer;
  @apply bg-gray-800
}
.day:hover {
  background-color: #d0d0d0;
}
.highlighted {
  background-color: #42a5f5;
  color: #ffffff;
}
</style>
