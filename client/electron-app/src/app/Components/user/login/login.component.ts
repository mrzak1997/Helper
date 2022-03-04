import { AlertService } from './../../shared/alert/alert.service';
import { UserService } from './../../../services/api/user.service';
import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder,Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Inject, PLATFORM_ID } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';
import {CookieService} from 'ngx-cookie-service';
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
  constructor(private fb: FormBuilder,private userApi : UserService, private alertService: AlertService,
    private router: Router, @Inject(PLATFORM_ID) private platformId: any,private cookieService:CookieService) {
    //electron.ipcRenderer.send('resize-me-please',[355,525]);
   }

  ngOnInit(): void {
  
  }
  submit(){
    this.userApi.login(this.loginForm.value).subscribe(res=>{
      console.log(res)
      if(res.body.Response.StatusNumber == "200"){
        this.displaySuccess(res.body.Response.ResponseMessage)
        if (isPlatformBrowser(this.platformId)) {
          
          
          this.cookieService.set('token',res.body.Response.Token,1)
          this.cookieService.set('user',this.loginForm.value.username,1)
        }
        this.userApi.getUserInfo(this.loginForm.value.username,res.body.Response.Token).subscribe(res=>{
          console.log(res)
        })
      }else{
        this.displayFailure(res.body.Response.ResponseMessage)
      }
    })
  }
  private displaySuccess(text:string) {
    
      this.alertService.success(text,
      
      )
    
  }
  private displayFailure(text:string){
    this.alertService.error(text,
      { autoClose: true}
    )
  }
  goToRegister(){
    console.log('log');
    this.router.navigate(['register'])
  }
}
