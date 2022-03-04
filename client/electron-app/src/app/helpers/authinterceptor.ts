import { Injectable } from '@angular/core';
import {
  HttpEvent, HttpInterceptor, HttpHandler, HttpRequest
} from '@angular/common/http';
import {CookieService} from 'ngx-cookie-service';
import { Observable } from 'rxjs';
import { 
   
    Inject, 
    PLATFORM_ID 
    } from '@angular/core';
  import { 
    isPlatformBrowser 
    } from '@angular/common';

/** Pass untouched request through to the next request handler. */
@Injectable()
export class AuthInterceptor implements HttpInterceptor {
    constructor( @Inject(PLATFORM_ID)
    private platformId: any,private cookieService:CookieService){
        
    }
    
    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        // add authorization header with basic auth credentials if available
        //const currentUser ='Basic ' + btoa('09128026607:123456')
        //'Bearer '
        let token = '';
       
        if (isPlatformBrowser(this.platformId)) {
        
            if (this.cookieService.check('token')) {
                let user = ''
                user = this.cookieService.get('user') || ''
                let Token = ''
                Token = this.cookieService.get('token') || ''
                request = request.clone({
                    setHeaders: { 
                        username: user,
                        Token: Token
                    
                    }
                });
            }
        }
        return next.handle(request);
    }
}