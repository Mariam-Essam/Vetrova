<script src="/js/chatting.js"></script>
<script src="/js/app.js"></script>
<script>

    const msg = $("#msg");
    const image = $("#image");
    const submit = $("#submit");
    const chatForm = $("#chatForm");

    chatForm.on("submit", (e)=>{
        console.log("HERE");
        e.preventDefault();
        return false;
    });

    submit.click(()=>{
        if(msg.val() == ""){
            return;
        }

        const formData = new FormData();

        
        formData.append("msg", msg.val())
        if(image[0].files.length){
            formData.append("image", image[0].files[0])
        }
        formData.append("_token", "{{ csrf_token() }}")

        console.log(formData);

        // $.ajax({
        //     url: "{{ route("chat.send", ["request" => $request]) }}",
        //     data: formData,
        //     success: (res)=>{
        //         console.log(res);
        //     }

        // });

        fetch("{{ route("chat.send", ["request"=>$request]) }}", {
            method: "POST",
            body: formData
        })
        .then(data => data.json())
        .then(res => {
              
            msg.val("");
            image.val(null);

            let className = "sent";

            let div = document.createElement("div");
            div.classList.add(className);
            div.classList.add("message");

            let imgDiv = document.createElement("div");
            imgDiv.classList.add("image");

            let img = document.createElement("img");
            img.src = "{{ $user->profile_pic }}"

            let p = document.createElement("p");
            let span = document.createElement("span")
            span.innerText = res.message.msg;
            p.appendChild(span);

            
            if(res.message.file){
                let file = document.createElement("span");
                file.classList.add("file");
                
                let a = document.createElement("a")
                a.href= res.message.file;
                a.target = "_blank";

                let img = document.createElement("img");
                img.src = res.message.file;
                a.appendChild(img);

                file.appendChild(a);

                p.appendChild(file);
            }

            div.appendChild(imgDiv);
            div.appendChild(p);
            imgDiv.appendChild(img);

            $("#chat-box").append(div);

        }).catch(err => {
            console.log(err);
        })

        
    });


    // ======== Listen To Events ========
    const userId= {{ Auth::id() }};
    const requestID = {{ $request->id }}
    Echo.private('chat.{{ Auth::id() }}')
        .listen('.message.sent', (e) => {
            console.log(e);
            console.log(userId);
            if(e.request.id != requestID) return;
            // Create new message
            let className = e.user.id == userId ? "sent" : "replies";

            

            let div = document.createElement("div");
            div.classList.add(className);
            div.classList.add("message");

            let imgDiv = document.createElement("div");
            imgDiv.classList.add("image");

            let img = document.createElement("img");
            img.src = e.user.profile_pic

            let p = document.createElement("p");
            let span = document.createElement("span")
            span.innerText = e.message.msg;
            p.appendChild(span);

            
            if(e.message.file){
                let file = document.createElement("span");
                file.classList.add("file");
                
                let a = document.createElement("a")
                a.href= e.message.file;
                a.target = "_blank";

                let img = document.createElement("img");
                img.src = e.message.file;
                a.appendChild(img);

                file.appendChild(a);

                p.appendChild(file);
            }


            div.appendChild(imgDiv);
            div.appendChild(p);
            imgDiv.appendChild(img);

            $("#chat-box").append(div);
            
            // <div class="replies message">
            //     <div class="image">
            //         <img src="images/chatting/3.jpg" alt="" />
            //         </div>
            //     <p>Blue, It's great but I feel red or pink , It would be awesome!</p>
            // </div>
            

            
        });


</script>
