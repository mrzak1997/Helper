import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, ValidationErrors, ValidatorFn, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/api/user.service';
import { AlertService } from '../../shared/alert/alert.service';
import { ConfirmPasswordValidator } from './confirm-password.validator';
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
    firstname: [''],
    lastname: [''],
    gender:[''],
    username : ['', [Validators.required,Validators.minLength(5)]],
    password : ['', [Validators.required,Validators.minLength(8)]],
    confirmPassword : ['',Validators.required],
    email : ['', [Validators.required,Validators.pattern('\^[^\s@]+@[^\s@]+\.[^\s@]+$')]],
    phone_number : ['', [Validators.required,Validators.pattern('\^09[0-9]{9}$')]],
    

  },
  {
    validator: ConfirmPasswordValidator("password", "confirmPassword")
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
    this.userApi.register(this.registerForm.value).subscribe(res=>{
      console.log(res)
      if(res.body.Response.StatusNumber == "201"){
        this.displaySuccess(res.body.Response.ResponseMessage)
        this.router.navigate(['dashboard']);
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
    
    this.router.navigate([''])
  }
  error(){
    console.log(this.registerForm.errors)

  }
  
}
