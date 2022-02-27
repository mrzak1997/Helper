import { UserService } from './../../../services/api/user.service';
import { Component, OnInit } from '@angular/core';
import { FormBuilder,Validators } from '@angular/forms';
//const electron = (<any>window)
//const electron = (<any>window).require('electron');
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  loginForm = this.fb.group({
    username : ['', Validators.required],
    password : ['', Validators.required]
  })
  constructor(private fb: FormBuilder,private userApi : UserService) {
    //electron.ipcRenderer.send('resize-me-please',[355,525]);
   }

  ngOnInit(): void {
  
  }
  submit(){
    this.userApi.login(this.loginForm.value).subscribe(res=>{
      console.log(res)
    })
  }
}
