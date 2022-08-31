<template>
  <div class="flex flex-wrap justify-center gap-5 px-3 pb-3">
    <div v-for="index in 8" :key="index">
      <div class="flex gap-5 rounded p-2 bg-gray-500 text-white">
        <div class="flex-col">
          <p class="text-xs">{{ this.timeConvert(day.time[index]) }}</p>
          <p class="font-bold">{{ Math.round(day.temps[index]) }}°C</p>
        </div>
        <div>
          <img
            :src="`https://openweathermap.org/img/wn/${day.icons[index]}.png`"
            alt=""
            width="35"
            height="30"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HourlyWeather",
  props: {
    currentTemperature: Object,
    day: Object,
  },
  methods: {
    timeConvert(time) {
      var timestamp = time * 1000;
      let hour = new Date(timestamp).getHours();
      let minutes = new Date(timestamp).getMinutes();
      let ampm = hour >= 12 ? "PM" : "AM";
      return hour + ":" + minutes + " ";
    },
  },
};
</script>