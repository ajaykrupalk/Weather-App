<template>
  <div class="flex flex-wrap justify-center gap-5 p-3">
    <template v-for="(temp, index) in temps" :key="index">
      <template v-if="temp.cur_date > date">
        <div class="flex gap-5 rounded p-2 bg-gray-500 text-white">
          <div class="flex-col">
            <p class="text-sm">{{ getDay(temp.cur_date) }}</p>
            <p class="font-bold">{{ temp.cur_temp }}°C</p>
          </div>
          <div>
            <p class="text-sm">{{ getTime(temp.cur_date) }}</p>
            <img
              :src="`https://openweathermap.org/img/wn/${temp.icon}.png`"
              alt=""
              width="35"
              height="30"
            />
          </div>
        </div>
      </template>
    </template>
  </div>
</template>

<script>
export default {
  data() {
    return {
      temps: [],
      date: "",
      today: "",
    };
  },
  mounted() {
    this.today = new Date();
    this.date = this.today.getFullYear();
    if (this.today.getMonth() + 1 < 10) {
      this.date += "-0" + (this.today.getMonth() + 1);
    } else {
      this.date += "-" + (this.today.getMonth() + 1);
    }
    this.date +=
      "-" +
      this.today.getDate() +
      " " +
      this.today.getHours() +
      ":" +
      this.today.getMinutes() +
      ":" +
      this.today.getSeconds();
    console.log(this.date);

    window.axios.get("/api/days").then((response) => {
      this.temps = response.data;
    });
  },
  methods: {
    getDay(timestamp) {
      const day = new Date(timestamp);
      const days = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];

      const date = days[day.getDay()];
      return date;
    },
    getTime(timestamp) {
      const day = new Date(timestamp);

      const date = (day.getHours() < 10 ? "0" : "") +
        day.getHours() + ":" + (day.getMinutes() < 10 ? "0" : "") +
        day.getMinutes();
      return date;
    },
  },
};
</script>