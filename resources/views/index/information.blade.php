@extends('layouts.app')

@section('title', '图片列表')

@section('content')
    <div id="contain" class="cf">
        <div>
            @foreach ($information as $item)
                <div class="images" ondblclick="editContent({{$item['id']}})">
                    <img src="{{$item['image']}}" alt="">

                    <div class="title">
                        <input title type="text" value="{{$item['title']}}">
                        <button onclick="changeTitle({{$item['id']}}, this)">更改</button>
                    </div>

                    <a href="{{URL::action('InformationController@delete', [$item['id'], basename($item['image'])])}}">删除资讯</a>
                </div>
            @endforeach
            <div class="images" id="drop">
                +
            </div>
        </div>
    </div>


    <div id="editor-container">
        <div id="editor" type="text/plain" style="height:500px;">
        </div>
    </div>
@endsection

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('#drop').on('dragover', function () {
            return false;
        }).on('drop', function (e) {
            var file = e.originalEvent.dataTransfer.files[0];
            var formData = new FormData();
            formData.append('_token', '{{csrf_token()}}');
            formData.append('picture', file);
            $.ajax({
                type: 'POST',
                url: '{{URL::action('InformationController@add')}}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {
                        window.location.reload();
                    }
                }
            });
            return false;
        });


        var weiwait = {};
        window.weiwait = weiwait;
        function editContent(id)
        {
            window.weiwait.id = id;
            $.get('{{URL::action('InformationController@getContent')}}', {id: id}, function (result) {
                clearLocalData();
                setContent(result.data.content);
            }, 'json');
        }

        function pushContent()
        {
            var data = getContent();

            $.post('{{URL::action('InformationController@pushContent')}}', {id: window.weiwait.id, data: data}, function (result) {
                if (result.status === 1) {
                    alert('编辑成功');
                } else {
                    alert('未知错误');
                    window.location.reload();
                }
            });
        }

        function changeTitle(id, obj)
        {
            var title = $(obj).siblings('input').val();
            $.get('{{URL::action('InformationController@title')}}', {id: id, data: title}, function (result) {
                if (result.status === 1) {
                    alert('编辑成功');
                } else {
                    alert('未知错误');
                    window.location.reload();
                }
            }, 'json');
        }
    </script>


    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');


        function isFocus(e){
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e)
        }
        function setblur(e){
            UE.getEditor('editor').blur();
            UE.dom.domUtils.preventDefault(e)
        }
        function insertHtml() {
            var value = prompt('插入html代码', '');
            UE.getEditor('editor').execCommand('insertHtml', value)
        }
        function createEditor() {
            enableBtn();
            UE.getEditor('editor');
        }
        function getAllHtml() {
            alert(UE.getEditor('editor').getAllHtml())
        }
        function getContent() {
            return UE.getEditor('editor').getContent();
        }
        function getPlainTxt() {
            var arr = [];
            arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getPlainTxt());
            alert(arr.join('\n'))
        }
        function setContent(content = '',isAppendTo) {
            UE.getEditor('editor').setContent(content, isAppendTo);
        }
        function setDisabled() {
            UE.getEditor('editor').setDisabled('fullscreen');
            disableBtn("enable");
        }

        function setEnabled() {
            UE.getEditor('editor').setEnabled();
            enableBtn();
        }

        function getText() {
            //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
            var range = UE.getEditor('editor').selection.getRange();
            range.select();
            var txt = UE.getEditor('editor').selection.getText();
            alert(txt)
        }

        function getContentTxt() {
            var arr = [];
            arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
            arr.push("编辑器的纯文本内容为：");
            arr.push(UE.getEditor('editor').getContentTxt());
            alert(arr.join("\n"));
        }
        function hasContent() {
            var arr = [];
            arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
            arr.push("判断结果为：");
            arr.push(UE.getEditor('editor').hasContents());
            alert(arr.join("\n"));
        }
        function setFocus() {
            UE.getEditor('editor').focus();
        }
        function deleteEditor() {
            disableBtn();
            UE.getEditor('editor').destroy();
        }
        function disableBtn(str) {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                if (btn.id == str) {
                    UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                } else {
                    btn.setAttribute("disabled", "true");
                }
            }
        }
        function enableBtn() {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            }
        }

        function getLocalData () {
            alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
        }

        function clearLocalData () {
            UE.getEditor('editor').execCommand( "clearlocaldata" );
        }
    </script>

    <script>  //添加完成编辑按钮
        UE.registerUI('完成编辑', function(editor, uiName) {
            //注册按钮执行时的command命令，使用命令默认就会带有回退操作
            editor.registerCommand(uiName, {
                execCommand: function() {
                    alert('execCommand:' + uiName)
                }
            });
            //创建一个button
            var btn = new UE.ui.Button({
                //按钮的名字
                name: uiName,
                //提示
                title: uiName,
                //添加额外样式，指定icon图标，这里默认使用一个重复的icon
                cssRules: 'background-image: url(ueditor/themes/default/images/icons-all.gif)!important;background-position: 10px -475px;',
                //点击时执行的命令
                onclick: function() {
                    //这里可以不用执行命令,做你自己的操作也可
                    pushContent();
                }
            });
            //当点到编辑内容上时，按钮要做的状态反射
            editor.addListener('selectionchange', function() {
                var state = editor.queryCommandState(uiName);
                if (state == -1) {
                    btn.setDisabled(true);
                    btn.setChecked(false);
                } else {
                    btn.setDisabled(false);
                    btn.setChecked(state);
                }
            });
            //因为你是添加button,所以需要返回这个button
            return btn;
        });
    </script>
@endpush