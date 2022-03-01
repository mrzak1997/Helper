import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/api/user.service';
import { AlertService } from '../../shared/alert/alert.service';
interface gender {
  value: string;
  viewValue: string;
}
@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  re =
  '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
  registerForm = this.fb.group({
    name: [''],
    lastName: [''],
    gender:[null],
    username : ['', [Validators.required,Validators.minLength(5)]],
    password : ['', [Validators.required,Validators.minLength(8)]],
    email : ['', [Validators.required,Validators.pattern('\^[^\s@]+@[^\s@]+\.[^\s@]+$')]],
    phoneNumber : ['', [Validators.required,Validators.pattern('\^09[0-9]{9}$')]],
    

  })
  genders: gender[] = [
    {value: '1', viewValue: 'زن'},
    {value: '2', viewValue: 'مرد'},
    {value: '3', viewValue: 'نمیگم'},
  ];
  constructor(private fb: FormBuilder,private userApi : UserService, private alertService: AlertService,
    private router: Router) { }

  ngOnInit(): void {
  }
  submit(){
    this.userApi.login(this.registerForm.value).subscribe(res=>{
      console.log(res)
      if(res.body.Response.StatusNumber == "200"){
        this.displaySuccess(res.body.Response.ResponseMessage)
        this.userApi.getUserInfo(this.registerForm.value.username,res.body.Response.Token).subscribe(res=>{
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
    this.router.navigate([''])
  }
  error(){
    console.log(this.registerForm.errors)

  }
  
}
