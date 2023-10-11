@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Frequently Asked Questions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Frequently Asked Questions</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section faq">
        <div class="row">
            <div class="col-lg-6">

                <div class="card basic">
                    <div class="card-body">
                        <h5 class="card-title">Basic Questions</h5>

                        <div>
                            <h6>1. Nisi ut ut exercitationem voluptatem esse sunt rerum?</h6>
                            <p>Saepe perspiciatis ea. Incidunt blanditiis enim mollitia qui voluptates. Id rem nulla tenetur nihil in unde rerum. Quae consequatur placeat qui cumque earum eius omnis quos.</p>
                        </div>

                        <div class="pt-2">
                            <h6>2. Reiciendis dolores repudiandae?</h6>
                            <p>Id ipsam non ut. Placeat doloremque deserunt quia tenetur inventore laboriosam dolores totam odio. Aperiam incidunt et. Totam ut quos sunt atque modi molestiae dolorem.</p>
                        </div>

                        <div class="pt-2">
                            <h6>3. Qui qui reprehenderit ut est illo numquam voluptatem?</h6>
                            <p>Enim inventore in consequuntur ipsam voluptatem consequatur beatae. Nostrum consequuntur voluptates et blanditiis.</p>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <!-- F.A.Q Group 2 -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Deserunt ut unde corporis</h5>

                        <div class="accordion accordion-flush" id="faq-group-2">

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-1" type="button" data-bs-toggle="collapse">
                                        Cumque voluptatem recusandae blanditiis?
                                    </button>
                                </h2>
                                <div id="faqsTwo-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        Ut quasi odit odio totam accusamus vero eius. Nostrum asperiores voluptatem eos nulla ab dolores est asperiores iure. Quo est quis praesentium aut maiores. Corrupti sed aut expedita fugit vero dolorem. Nemo rerum sapiente. A quaerat dignissimos.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-2" type="button" data-bs-toggle="collapse">
                                        Provident beatae eveniet placeat est aperiam repellat adipisci?
                                    </button>
                                </h2>
                                <div id="faqsTwo-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        In minus quia impedit est quas deserunt deserunt et. Nulla non quo dolores minima fugiat aut saepe aut inventore. Qui nesciunt odio officia beatae iusto sed voluptatem possimus quas. Officia vitae sit voluptatem nostrum a.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-3" type="button" data-bs-toggle="collapse">
                                        Minus aliquam modi id reprehenderit nihil?
                                    </button>
                                </h2>
                                <div id="faqsTwo-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        Voluptates magni amet enim perspiciatis atque excepturi itaque est. Sit beatae animi incidunt eum repellat sequi ea saepe inventore. Id et vel et et. Nesciunt itaque corrupti quia ducimus. Consequatur maiores voluptatum fuga quod ut non fuga.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-4" type="button" data-bs-toggle="collapse">
                                        Quaerat qui est iusto asperiores qui est reiciendis eos et?
                                    </button>
                                </h2>
                                <div id="faqsTwo-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        Numquam ut reiciendis aliquid. Quia veritatis quasi ipsam sed quo ut eligendi et non. Doloremque sed voluptatem at in voluptas aliquid dolorum.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-target="#faqsTwo-5" type="button" data-bs-toggle="collapse">
                                        Laboriosam asperiores eum?
                                    </button>
                                </h2>
                                <div id="faqsTwo-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                                    <div class="accordion-body">
                                        Aut necessitatibus maxime quis dolor et. Nihil laboriosam molestiae qui molestias placeat corrupti non quo accusamus. Nemo qui quis harum enim sed. Aliquam molestias pariatur delectus voluptas quidem qui rerum id quisquam. Perspiciatis voluptatem voluptatem eos. Vel aut minus labore at rerum eos.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!-- End F.A.Q Group 2 -->

            </div>

        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection