<template>

  <div class="card-carousel-wrapper">
    <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
    <div style="width:97%;position:relative;left:-25px;" class="card-carousel">
      <div class="card-carousel--overflow-container">
        <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
          <div class="card-carousel--card" style="border-radius:10px;" v-for="(product_offer, index) in product_offers">
            <div @click="delete_product_offer(index)" class="cross"></div>
            <div class="card-carousel--card--footer">
              <p style="font-weight:500;">{{ product_offer.product.title }}</p>
              <div class="row">
                <div style="padding-left:0" class="col s6">
                  <div>{{ product_offer.date_start }}</div>
                  <div>{{ product_offer.date_end }}</div>
                </div>
                <div style="padding-right:0;padding-left:35px;text-align:center;" class="col s6">
                  <button @click="decrement_product_offer(index)" class="decrement_button">
                    <span>–</span>
                  </button><span style="vertical-align:middle;display: inline-block;margin-left:11px;font-size:17px;width:24px;">{{ product_offer.count }}</span><button class="increment_button" @click="increment_product_offer(index)">
                  <span>+</span>
                </button>
                  <div style="text-align:center;margin-top:10px;" class="total-price"><span style="display:inline-block;font-size:18px;font-weight:bold;">{{ +product_offer.product.price * +product_offer.count }} ₽</span></div>
                </div>

              </div> <!-- row -->
              <p style="font-size: 16px;font-weight: normal;" class="tag">{{ product_offer.delivery }}</p>
<!--              <p class="tag" v-for="(tag,index) in item.tag" :class="index &gt; 0 ? 'secondary' : ''">{{ tag }}</p>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div>
  </div>

</template>

<script>
export default {
  name: "carousel",
  props: ['product_offers'],
  data() {
    return {
      currentOffset: 0,
      windowSize: 3,
      paginationFactor: 220,
    }
  },
  computed: {

    atEndOfList() {
      return this.currentOffset <= (this.paginationFactor * -1) * (this.product_offers.length - this.windowSize);
    },

    atHeadOfList() {
      return this.currentOffset === 0;
    },

  },
  mounted() {
    this.delayy(10000)
  },
  methods: {

    delete_product_offer(product_offer_index) {
      this.$store.dispatch('delete_product_offer', product_offer_index)
    },

    decrement_product_offer(product_offer_index) {
      this.$store.dispatch('decrement_product_offer', product_offer_index)
    },

    increment_product_offer(product_offer_index) {
      this.$store.dispatch('increment_product_offer', product_offer_index)
    },

    moveCarousel(direction) {
      // Find a more elegant way to express the :style. consider using props to make it truly generic
      if (direction === 1 && !this.atEndOfList) {
        this.currentOffset -= this.paginationFactor;
      } else if (direction === -1 && !this.atHeadOfList) {
        this.currentOffset += this.paginationFactor;
      }
    },
    async delayy(time) {
      setTimeout(() => {
       // console.log('Подписки в квитацнии', this.$store.getters.local_receipt)
        this.delayy(time)
      }, 10000)
    }
  }
}
</script>

<style scoped lang="scss">
$vue-navy: #2c3e50;
$vue-navy-light: #3a5169;
$vue-teal: #42b883;
$vue-teal-light: #42b983;
$gray: #666a73;
$light-gray: #f8f8f8;

/*
Custom
 */

.increment_button {
  cursor:pointer;
  width:24px;
  height:24px;
  vertical-align:middle;
  border:none;
  background:#B4E7D4;
  border-radius:50%;
  margin-left:11px;
  font-size:24px;
}

.increment_button span {
  position: relative;
  top: -5px;
  left: -2.1px;
  color: #3F3F3F;
}

.decrement_button {
  cursor: pointer;
  width: 24px;
  height: 24px;
  vertical-align: middle;
  border: none;
  background: rgb(244, 180, 153);
  border-radius: 50%;
  font-size: 23px;
}

.decrement_button span {
  color: #3F3F3F;
  position: relative;
  top: -5px;
}


/*
Custom
 */


body {
  background: $light-gray;
  color: $vue-navy;
  font-family: 'Source Sans Pro', sans-serif;
}

.card-carousel-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 20px 0 40px;
  margin-bottom:25px;
  color: $gray;
}

.card-carousel {
  display: flex;
  justify-content: center;
  width: 100%;

  &--overflow-container {
    //overflow: hidden;
  }

  &--nav__left,
  &--nav__right {
    display: inline-block;
    width: 15px;
    height: 15px;
    padding: 10px;
    box-sizing: border-box;
    border-top: 2px solid $vue-teal;
    border-right: 2px solid $vue-teal;
    cursor: pointer;
    margin: 0 20px;
    transition: transform 150ms linear;
    &[disabled] {
      opacity: 0.2;
      border-color: black;
    }
  }

  &--nav__left {
    transform: rotate(-135deg);
    &:active {
      transform: rotate(-135deg) scale(0.9);
    }
  }

  &--nav__right {
    transform: rotate(45deg);
    &:active {
      transform: rotate(45deg) scale(0.9);
    }
  }
}

.card-carousel-cards {
  border-radius:11px;
  //overflow:hidden;
  display: flex;
  transition: transform 150ms ease-out;
  transform: translatex(0px);

  .card-carousel--card {
    position: relative;
    width:300px;
    min-height:210px;
    margin: 0 10px;
    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.12), 0px 0px 4px rgba(0, 0, 0, 0.2), inset 0px 0px 33px rgba(254, 197, 130, 0.14);
    background-color: #fff;
    border-radius: 4px;
    z-index: 3;
    margin-bottom: 2px;

    &:first-child {
      margin-left: 0;
    }

    &:last-child {
      margin-right: 0;
    }

    img {
      vertical-align: bottom;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
      transition: opacity 150ms linear;
      user-select: none;

      &:hover {
        opacity: 0.5;
      }
    }

    &--footer {
      border-top: 0;
      padding: 7px 15px;
      padding-right: 27px;

      p {
        padding: 3px 0;
        margin: 0;
        margin-bottom: 2px;
        font-size: 18px;
        //font-weight: 500;
        color: $vue-navy;
        user-select: none;

        &.tag {
          font-size: 11px;
          font-weight: 300;
          padding: 4px;
          background: rgba(40,44,53,.06);
          display: inline-block;
          position: relative;
          margin-left: 4px;
          color: $gray;

          &:before {
            content:"";
            float:left;
            position:absolute;
            top: 6px;
            left: -12px;
            width:0;
            height:0;
            border-color:transparent rgba(40,44,53,.06) transparent transparent;
            border-style:solid;
            border-width:8px 12px 12px 0;
          }
          &.secondary {
            margin-left: 0;
            border-left: 1.45px dashed white;
            &:before {
              display: none !important;
            }
          }

          &:after {
            content:"";
            position:absolute;
            top:4px;
            left:5px;
            float:left;
            width:4px;
            height:4px;
            border-radius: 2px;
            background: white;
            box-shadow:-0px -0px 0px #004977;
          }
        }
      }
    }
  }
}

h1 {
  font-size: 3.6em;
  font-weight: 100;
  text-align: center;
  margin-bottom: 0;
  color: $vue-teal;
}
</style>
