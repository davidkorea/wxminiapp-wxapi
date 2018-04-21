// pages/templatemsg/templatemsg.js

// var app = App
var app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    date:'2018-04-21',
    time:'09:30'
  },
  bindTimeChange: function (e) {
    // console.log(e)
    this.setData({
      time: e.detail.value
    })
  },


  bindDateChange:function(e){
    // console.log(e)
    this.setData({
      date:e.detail.value
    })
  },

  formSubmit:function(e){
    console.log(e)

    //html每个输入项都必须有name属性，从而Submit是可以获取到相应输入项的数值value
    var openid = app.openid
    var formId = e.detail.formId;
    var values = e.detail.value;
    var site = values.site;
    var date = values.date;
    var time = values.time;
    var name = values.name;
    var seat = values.seat;
    // console.log(openid) //不知道为什么打印出来是undefined??
    wx.request({
      url: 'https://davidkorea.applinzi.com/templatephp.php',
      data: {
        opeid:openid,
        formId: formId,
        name:name,
        date:date,
        time:time,
        site:site,
        seat:seat,
      },
      header: {
        'content-type': 'application/json'
      },
      success: function(res) {
        console.log(res.data)
      },
    })

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    // console.log(app.openid)
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})
