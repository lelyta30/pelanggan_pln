<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = Post::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:posts|numeric'
        ]);

        $post = new Post;
        $post->phone = $request->phone;
        $post->save();

        $this->sendMessage('Post registered successfully!!', $request->phone);
        return back()->with(['success' => "{$request->phone} registered"]);
    }

    public function sendCustomMessage(Request $request)
    {
        $request->validate([
            'post' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $request->post;

        foreach ($recipients as $recipient) {
            $this->sendMessage($request->body, $recipient);
        }
        return back()->with(['success' => "Message on its way to recipients!"]);
    }

    private function sendMessage($message, $recipient)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");

        $client = new Client($account_sid, $auth_token);

        try {
            $client->messages->create($recipient, [
                'from' => $twilio_number,
                'body' => $message,
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during sending, e.g., log or return an error message.
            // You might want to implement proper error handling here.
            \Log::error("Twilio error: {$e->getMessage()}");
        }
    }
    public function statusCallback(Request $request)
    {
        $messageStatus = $request->input('MessageStatus');
        $messageSid = $request->input('MessageSid');
    
        // Lakukan sesuatu berdasarkan status pesan
        if ($messageStatus === 'sent') {
            // Pesan berhasil terkirim, lakukan tindakan yang sesuai
            // Contoh: Catat status pengiriman ke database
            $this->logMessageStatus($messageSid, 'sent');
    
            // Contoh: Kirim notifikasi bahwa pesan telah terkirim
            $this->sendNotification('Pesan telah terkirim');
        } elseif ($messageStatus === 'delivered') {
            // Pesan telah berhasil diantarkan (delivered), lakukan tindakan yang sesuai
            // Contoh: Catat status pengantaran ke database
            $this->logMessageStatus($messageSid, 'delivered');
    
            // Contoh: Kirim notifikasi bahwa pesan telah diantarkan
            $this->sendNotification('Pesan telah diantarkan');
        } elseif ($messageStatus === 'failed') {
            // Pesan gagal terkirim, lakukan tindakan yang sesuai
            // Contoh: Catat status pengiriman yang gagal ke database
            $this->logMessageStatus($messageSid, 'failed');
    
            // Contoh: Kirim notifikasi bahwa pesan gagal terkirim
            $this->sendNotification('Pesan gagal terkirim');
        }    
        // Berikan respons HTTP 200 OK sebagai konfirmasi kepada Twilio
        return response('Callback received', 200);
    }
    
    private function logMessageStatus($messageSid, $status)
    {
        // Simpan status pesan ke database atau tempat lain sesuai kebutuhan Anda
        // Contoh: Gunakan model atau kode yang sesuai
        // Misalnya, jika Anda memiliki model MessageStatus:
        // MessageStatus::create(['message_sid' => $messageSid, 'status' => $status]);
    }
    
    private function sendNotification($message)
    {
        // Kirim notifikasi ke penerima atau lakukan tindakan sesuai kebutuhan Anda
        // Contoh: Kirim notifikasi ke pengguna melalui email, SMS, atau layanan notifikasi lainnya
    }
    
}