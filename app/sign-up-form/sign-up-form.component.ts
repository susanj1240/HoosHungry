import { Component, Inject, OnInit } from '@angular/core'; // Inject reference: https://ultimatecourses.com/blog/angular-dependency-injection#inject
import { User } from '../user';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import {SESSION_STORAGE, StorageService, StorageTranscoders } from 'ngx-webstorage-service';
import { CookieService } from 'ngx-cookie-service'; // Reference: https://stackoverflow.com/questions/50772529/what-is-the-equivalent-to-angularjss-ngcookie-in-angular-6
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-sign-up-form',
  templateUrl: './sign-up-form.component.html',
  styleUrls: ['./sign-up-form.component.css']
})
export class SignUpFormComponent implements OnInit {

  // Reference: https://angular.io/guide/forms-overview
  
  title = "Sign Up";
  signup = "Sign Up";

  model = new User('', '', '');
  responsedata = new User('', '', '');
  confirm_msg = 'before confirm';
  data_submitted = '';

  submitted = false;

  onSubmit(form: any): void { 
    console.log('You submitted value: ', form);
    this.cookieService.set('username', this.model.signUpEmail); // Reference: https://itnext.io/angular-8-how-to-use-cookies-14ab3f2e93fc
    this.data_submitted = form;
    let params = JSON.stringify(form);
    this.http.post<User>('http://localhost/cs4640/Project%20current/php/sign-up.php', params) // CHANGE URL DEPENDING ON XAMPP SETUP
    .subscribe((data) => {
      console.log('Response ', data);
      this.responsedata = data;
      window.location.href= "http://localhost/cs4640/Project%20current/php/login.php"; // CHANGE URL DEPENDING ON XAMPP SETUP
    }, (error) => {
      console.log('Error ', error);
      window.location.href= "http://localhost/cs4640/Project%20current/php/login.php"; // CHANGE URL DEPENDING ON XAMPP SETUP
    })
  }

  constructor(private http: HttpClient, private cookieService:CookieService) { 
    
  }

  ngOnInit(): void {

  }
}
