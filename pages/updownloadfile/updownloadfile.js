// pages/updownloadfile/updownloadfile.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    image:null
  },

  upload:function(){
    var that = this;
    wx.chooseImage({
      count: 1, // 默认9
      sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
      success: function (res) {
        // 返回选定照片的本地文件路径列表，tempFilePath可以作为img标签的src属性显示图片
        var tempFilePaths = res.tempFilePaths
        //显示image
        console.log(res.tempFilePaths[0])
        that.setData({
          image:res.tempFilePaths[0]
        })

      //upload image
      wx.uploadFile({
        url: 'https://davidkorea.applinzi.com/updown.php', //仅为示例，非真实的接口地址
        filePath: tempFilePaths[0],
        name: 'fileup',       
        success: function (res) {
          var data = res.data
          console.log(data)
        },
        fail:function(){
          console.log('upload failed TT')
        }
      })


      }
    })
  },


  download:function(){
    var that = this;
    wx.downloadFile({
      url: 'https://davidkorea.applinzi.com/G0151766.JPG',
      success: function(res) {
        console.log('download success!!!')
        console.log(res.tempFilePath)
        that.setData({
          image: res.tempFilePath
        });
      },
       
    })
  },















  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
  
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