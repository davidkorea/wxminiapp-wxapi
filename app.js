App({

  openid:null,
  onLaunch: function () {
    var that = this;
    wx.login({
      success: function (res) {
        // console.log(res.code);
        wx.request({
          url: 'https://davidkorea.applinzi.com/logincode.php',
          data: {
            code: res.code
          },
          header: {
            'content-type': 'application/json'
          },
          success: function (res) {
            var data = res.data;
            var openid = data.openid;
            that.openid = openid;
            console.log(openid)
          },

        })
      },

    })

  },

  /**
   * 当小程序启动，或从后台进入前台显示，会触发 onShow
   */
  onShow: function (options) {
    
  },

  /**
   * 当小程序从前台进入后台，会触发 onHide
   */
  onHide: function () {
    
  },

  /**
   * 当小程序发生脚本错误，或者 api 调用失败时，会触发 onError 并带上错误信息
   */
  onError: function (msg) {
    
  }
})
