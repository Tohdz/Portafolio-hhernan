package com.ProyectoFinal.ProyectoFinal;

import java.util.Locale;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.MessageSource;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.support.ResourceBundleMessageSource;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.web.servlet.LocaleResolver;
import org.springframework.web.servlet.config.annotation.InterceptorRegistry;
import org.springframework.web.servlet.config.annotation.ViewControllerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import org.springframework.web.servlet.i18n.LocaleChangeInterceptor;
import org.springframework.web.servlet.i18n.SessionLocaleResolver;

@Configuration
public class ProjectConfig implements WebMvcConfigurer {

    @Bean
    public LocaleResolver localeResolver() {
        var slr = new SessionLocaleResolver();
        slr.setDefaultLocale(Locale.getDefault());
        slr.setLocaleAttributeName("session.current.locale");
        slr.setTimeZoneAttributeName("session.current.timezone");
        return slr;
    }

    @Bean
    public LocaleChangeInterceptor localeChangeInterceptor() {
        var lci = new LocaleChangeInterceptor();
        lci.setParamName("lang");
        return lci;
    }

    @Override
    public void addInterceptors(InterceptorRegistry registro) {
        registro.addInterceptor(localeChangeInterceptor());
    }

    @Bean("messageSource")
    public MessageSource messageSource() {
        ResourceBundleMessageSource messageSource = new ResourceBundleMessageSource();
        messageSource.setBasenames("messages");
        messageSource.setDefaultEncoding("UTF-8");
        return messageSource;
    }

    /* Los siguiente métodos son para implementar el tema de seguridad dentro del proyecto */
    @Override
    public void addViewControllers(ViewControllerRegistry registry) {
        registry.addViewController("/").setViewName("index");
        registry.addViewController("/index").setViewName("index");
        registry.addViewController("/login").setViewName("login");
        registry.addViewController("/about").setViewName("about");
        registry.addViewController("/registro/nuevo").setViewName("/registro/nuevo");
    }

    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
                .authorizeHttpRequests((request) -> request.requestMatchers("/errores/**","/**","/","/index","/js/**","/css/**","/images/**","/webjars/**","/contacto/contact","/contacto/guardar").permitAll()
                        .requestMatchers("/games","registro/nuevo","registro/salida","/emulador/emulist","/tutorial/Tutolist","/noticia/newslist","/about")
                        .hasRole("USER")
                        .requestMatchers(
                        "/contacto/list", "/contacto/eliminar/**",
                        "/emulador/emulist", "/emulador/listado", "/emulador/modificar/**", "/emulador/eliminar/**", "/emulador/guardar",
                        "/games", "/games/agregar", "/games/modificar", "/games/eliminar",
                        "/noticia/newslist", "/noticia/listado", "/noticia/eliminar/**", "/noticia/modificar/**", "/noticia/guardar", "/noticia/guardar2/**",
                        "/registro/nuevo", "/registro/recordar", "/registro/crearUsuario", "/registro/activacion/**", "/registro/activar", "/registro/recordarUsuario","registro/salida",
                        "/tutorial/Tutolist", "/tutorial/listado", "/tutorial/eliminar/**", "/tutorial/modificar/**", "/tutorial/guardar", "/tutorial/guardar2/**",
                        "/usuario/listado", "/usuario/nuevo", "/usuario/guardar", "/usuario/eliminar/**", "/usuario/modificar/**"
                ).hasRole("ADMIN")).formLogin((form) -> form.loginPage("/login").permitAll()).logout((logout) -> logout.permitAll());
        return http.build();
    }

    @Autowired
    private UserDetailsService userDetailsService;

    @Autowired
    public void configurerGlobal(AuthenticationManagerBuilder build) throws Exception {
        build.userDetailsService(userDetailsService).passwordEncoder(new BCryptPasswordEncoder());

    }
}
