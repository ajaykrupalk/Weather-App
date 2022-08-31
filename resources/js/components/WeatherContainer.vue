<template>
  <div
    class="
      font-sans
      w-128
      max-w-lg
      overflow-hidden
      rounded-lg
      bg-gray-900
      shadow-lg
      mt-4
    "
  >
    <CurrentWeather
      :currentTemperature="currentTemperature"
      :location="location"
      :day="day"
    />
    <FutureWeather :getIcons="getIcons" :daily="daily" />
  </div>
</template>

<script>
import CurrentWeather from "./CurrentWeather.vue";
import FutureWeather from "./FutureWeather.vue";

export default {
  mounted() {
    this.fetchLocation();
    this.fetchData();
  },
  data() {
    return {
      location: {
        name: "Bangalore, India",
        lat: 12.9716,
        lon: 77.5946,
      },
      indice: 7,
      daily: [],
      day: {
        temps: [],
        time: [],
        icons: [],
      },
      currentTemperature: {
        actual: "",
        feelsLike: "",
        summary: "",
        icon: "",
      },
    };
  },
  methods: {
    fetchLocation() {
      fetch(`/api/location`)
        .then((response) => response.json())
        .then((data) => {
          this.location.name =
            data.geoplugin_city + ", " + data.geoplugin_regionName;
          this.location.lat = data.geoplugin_latitude;
          this.location.lon = data.geoplugin_longitude;
        });
    },
    fetchData() {
      var skycons = new Skycons({ color: "white" });

      fetch(`/api/weather?lat=${this.location.lat}&lon=${this.location.lon}`)
        .then((response) => response.json())
        .then((data) => {
          console.log(data);

          this.currentTemperature.actual = Math.round(data.list[0].main.temp);
          this.currentTemperature.feelsLike = Math.round(
            data.list[0].main.feels_like
          );
          this.currentTemperature.summary = data.list[0].weather[0].description;
          this.currentTemperature.icon = this.getIcons(
            data.list[0].weather[0].description
          );

          while (this.indice < data.list.length) {
            this.daily.push(data.list[this.indice]);
            this.indice += 7;
          }

          this.indice = 0;
          while (this.indice < 9) {
            this.day.temps.push(data.list[this.indice].main.temp);
            this.day.time.push(data.list[this.indice].dt);
            this.day.icons.push(data.list[this.indice].weather[0].icon);
            this.indice += 1;
          }

          console.log(this.day.icons);

          skycons.add("iconCurrent", this.currentTemperature.icon);
          skycons.play();

          return data;
        });
    },
    getIcons(string) {
      const d = new Date();
      let hour = d.getHours();
      if (string === "clear sky") {
        if (hour >= 6 && hour <= 18) {
          return "clear-day";
        } else {
          return "clear-night";
        }
      } else if (
        string === "shower rain" ||
        string === "moderate rain" ||
        string === "light rain"
      ) {
        return "rain";
      } else if (string === "snow") {
        return "snow";
      } else if (string === "rain" || string === "thunderstorm") {
        return "sleet";
      } else if (string === "wind") {
        return "wind";
      } else if (string === "	mist") {
        return "fog";
      } else if (
        string === "scattered clouds" ||
        string === "broken clouds" ||
        string === "overcast clouds"
      ) {
        return "cloudy";
      } else if (string === "few clouds") {
        if (hour > 6 && hour < 18) {
          return "partly-cloudy-day";
        }
        return "partly-cloudy-night";
      }
    },
  },
  components: {
    FutureWeather,
    CurrentWeather,
  },
};
</script>