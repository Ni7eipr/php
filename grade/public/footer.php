  <!-- 用户登录 -->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 15%">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
              <h4 class="modal-title" id="myModalLabel"> 用户登录 敬请期待</h4>
           </div>
          <div class="modal-body">
            <form class="" action="" method="post">
              <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">账号</span>
                    <input type="text" class="form-control" placeholder="请输入您的账号" name="username"required autofocus/>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">密码</span>
                    <input type="password" class="form-control" placeholder="请输入您的密码" name="password"required/>
                </div>
              </div>
          </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <a type="submit" class="disabled btn btn-primary">登录</a>
              <a href ="./users/register.php" class="disabled btn btn-info">注册</a>
            </form>
           </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div><!-- 模态框（Modal） -->


    <!-- 管理员登录 -->
  <div class="modal fade" id="admModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 15%">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
              <h4 class="modal-title" id="myModalLabel"> 管理员登录 </h4>
           </div>
          <div class="modal-body">
            <form class="" action="" method="post">
              <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">账号</span>
                    <input type="text" class="form-control" placeholder="请输入您的账号" name="adminname"required autofocus/>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">密码</span>
                    <input type="password" class="form-control" placeholder="请输入您的密码" name="password"required/>
                </div>
              </div>
          </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">登录</button>
            </form>
           </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div><!-- 模态框（Modal） -->
    <script src="<?php echo $ROOTDIR; ?>/look/js/jquery.min.js"></script>
    <script src="<?php echo $ROOTDIR; ?>/look/js/bootstrap.min.js"></script>
</body>
</html>
