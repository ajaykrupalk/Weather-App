<template>
  <div class="flex items-center justify-between px-6 py-8">
    <div class="flex items-center">
      <!-- Describes the current weather details -->
      <div>
        <div class="text-6xl font-semibold">
          {{ currentTemperature.actual }}°C
        </div>
        <div>Feels like {{ currentTemperature.feelsLike }}°C</div>
      </div>
      <!-- Describes the weather-information -->
      <div class="mx-5">
        <div class="font-semibold">
          {{ currentTemperature.summary }}
        </div>
        <div>
          {{ location.name }}
        </div>
      </div>
    </div>
    <!-- Icon for the weather -->
    <div>
      <canvas
            id="iconCurrent"
            ref="iconCurrent"
            width="128"
            height="128"
          ></canvas>
    </div>
  </div>
</template>

<script>
export default {
  name: "CurrentWeather",
  mounted() {
    this.fetchIcons();
  },
  props: {
    currentTemperature: Object,
    location: Object,
  },
  methods: {
    fetchIcons(){
      var skycons = new Skycons({ color: "white" });
      skycons.add("iconCurrent", this.currentTemperature.icon);
      skycons.play();
    }
  }
};
</script>
