<template>
  <div class="future-weather text-sm bg-gray-800 px-6 py-8 overflow-hidden">
    <div
      v-for="(day, index) in daily"
      :key="day.dt"
      class="flex items-center mt-5"
      :class="{ 'mt-8': index > 0 }"
    >
      <div class="w-1/6 text-lg text-gray-200">
        {{ toDayOfWeek(day.dt) }}
      </div>
      <div class="w-4/6 px-4 flex items-center">
        <div>
          <canvas
            :id="`icon${index + 1}`"
            :day-icon="getdayIcon()"
            :data-icon="getIcons(day.weather[0].description)"
            width="24"
            height="24"
          ></canvas>
        </div>
        <div class="ml-3">
          {{ day.weather[0].description }}
        </div>
      </div>
      <div class="w-1/6 text-right">
        <div>
          {{ Math.round(day.main.temp_max) }}°C
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FutureWeather',
  // mounted(){
  //   this.getdayIcon();
  // },
  props: {
    daily: Array,
    getIcons: Function,
  },
  methods: {
    toDayOfWeek(timestamp) {
      const newDate = new Date(timestamp * 1000);
      const days = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];

      return days[newDate.getDay()];
    },
    getdayIcon(){
      var skycons = new Skycons({ color: "white" });
      
      this.$nextTick(() => {
            skycons.add(
              "icon1",
              document.getElementById("icon1").getAttribute("data-icon")
            );
            skycons.add(
              "icon2",
              document.getElementById("icon2").getAttribute("data-icon")
            );
            skycons.add(
              "icon3",
              document.getElementById("icon3").getAttribute("data-icon")
            );
            skycons.add(
              "icon4",
              document.getElementById("icon4").getAttribute("data-icon")
            );
            skycons.add(
              "icon5",
              document.getElementById("icon5").getAttribute("data-icon")
            );
          });

        skycons.play();
    },
  }
}
</script>