<template>
  <div class="main">
    <div class="logo">
      <img src="./assets/images/logo.png"/>
    </div>
    <mu-paper :zDepth="1" class="pay">

      <form @submit.prevent="handlePaySubmit" action="api.php" method="get" target="_blank">
        <mu-text-field label="各位行行好吧" hintText="请输入支付金额" type="text" labelFloat class="my-input mb0" v-model.number="amount"/>
        <mu-row gutter class="payway">
          <mu-col width="100" tablet="100" desktop="100" v-for="way in payway" :key="way.name">
            <a href="javascript:void(0)" class="shortcut-tile">
              <div class="icon-default" :class="'icon-'+ way.name + (chooseWay === way.value?' choose':'')"
                   @click="chooseWay=way.value"></div>
            </a>
          </mu-col>
        </mu-row>
        <div class="btn-container">
          <mu-button flat primary @click="handlePaySubmit" class="pay-btn">支付</mu-button>
        </div>

      </form>
    </mu-paper>
    <mu-dialog :open.sync="dialog.show" width="360" :title="dialog.title">
      <span v-html="dialog.message"></span>
      <mu-button slot="actions" flat color="primary" @click="dialog.show=false">确定</mu-button>
    </mu-dialog>
  </div>
</template>


<script>
  export default {
    data () {
      let isMobile = this.isMobile();
      return {
        amount: 1,
        payway: [
          { name: 'ali', value: isMobile ? 'alipaywap' : 'alipay' },
          { name: 'wx', value: isMobile ? 'wxwap' : 'wx' },
          { name: 'qq', value: isMobile ? 'qqwap' : 'qq' }
        ],
        chooseWay: '', //选择的支付方式
        dialog: {
          show: false,
          title: '提示',
          message: ''
        }
      }
    },
    methods: {
      alert (message, title = '提示') {
        this.dialog.message = message;
        this.dialog.title = title;
        this.dialog.show = true;
      },
      handlePaySubmit () {
        this.amount = +this.amount;
        if (this.amount < 0.01) {
          return this.alert('请给多一点吧');
        }
        if (this.chooseWay === '') {
          return this.alert('请选择支付方式');
        }
        window.open('/api.php?payway=' + this.chooseWay + '&amount=' + this.amount);
        return true;

      },
      isMobile () {
        return navigator.userAgent.match(/(iPhone|iPod|Android|ios|SymbianOS)/i) != null
      },
    }

  }

</script>

<style lang="less" type="text/less" scoped>
  .main {
    max-width: 360px;
    margin: 0 auto;
    padding: 20px 0;
  }

  .logo {
    width: 100%;
    text-align: center;
  }

  .pay {
    padding: 10px 12px;
  }

  .my-input {
    width: 100%;
  }

  .btn-container {
    height: 40px;
    .pay-btn {
      float: right;
    }
  }

  .payway {
    text-align: center;
    .shortcut-tile {
      font-size: 30px;
      line-height: 30px;
      display: inline-block;
    }
    .alert {
      margin: 0 23px 12px 23px !important;
    }
    .choose {
      outline: 1px solid #03a9f4;
    }
    .tile-body {
      height: 85px;
    }
    .icon-default {
      margin: 0 auto;
      width: 180px;
      height: 65px;
      background: url(./assets/images/payway.png) 0 0 no-repeat;
    }
    .icon-ali {
      background-position: 0 0;
    }
    .icon-wx {
      background-position: 0 -64px;
    }
    .icon-qq {
      background-position: 0 -128px;
    }
  }
</style>
